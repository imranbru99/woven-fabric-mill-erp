<?php

declare(strict_types=1);

/**
 * Generates migrations, models, factories, policies and Filament resources
 * from database/schema/tables.php. Re-run after schema edits.
 *
 * php scripts/generate.php
 */

use Illuminate\Support\Str;

require __DIR__.'/../vendor/autoload.php';

$tables = require __DIR__.'/../database/schema/tables.php';

$root = dirname(__DIR__);
foreach (['app/Models', 'app/Policies', 'app/Filament/Resources', 'database/factories'] as $dir) {
    if (! is_dir($root.'/'.$dir)) {
        mkdir($root.'/'.$dir, 0777, true);
    }
}
$created = ['users' => true];
$migration = [];
$migration[] = <<<'PHP'
<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
PHP;

$sort = 0;
$modelMap = [];
foreach ($tables as $table) {
    if (! empty($table['model'])) {
        $modelMap[$table['table']] = $table['model'];
    }
}

$fkModels = fkMap();

foreach ($tables as $table) {
    $name = $table['table'];
    $isAlter = ($table['alter'] ?? null) === 'users' || ($table['alter'] ?? false) === true;
    $pivot = (bool) ($table['pivot'] ?? false);
    $nobranch = (bool) ($table['nobranch'] ?? false) || $pivot || $isAlter;
    $noaudit = (bool) ($table['noaudit'] ?? false) || $pivot || $isAlter;

    $body = [];
    foreach ($table['cols'] as $spec) {
        $col = parseCol($spec);
        $body[] = '            '.emitColumn($col, $created);
    }

    if (! $nobranch && $name !== 'branches') {
        $body[] = "            \$table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();";
    }
    if (! $noaudit) {
        $body[] = "            \$table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();";
        $body[] = "            \$table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();";
        $body[] = '            $table->softDeletes();';
        $body[] = '            $table->timestamps();';
    } elseif ($isAlter) {
        $body[] = '            $table->softDeletes();';
    }

    $inner = implode("\n", $body);
    if ($isAlter) {
        $migration[] = <<<PHP

        Schema::table('users', function (Blueprint \$table) {
{$inner}
        });
PHP;
    } else {
        $migration[] = <<<PHP

        Schema::create('{$name}', function (Blueprint \$table) {
            \$table->id();
{$inner}
        });
PHP;
        $created[$name] = true;
    }

    if ($pivot || $isAlter || empty($table['model'])) {
        continue;
    }

    $sort++;
    writeModel($root, $table, $fkModels, $nobranch);
    writeFactory($root, $table);
    writePolicy($root, $table);
    writeResource($root, $table, $sort);
}

$migration[] = <<<'PHP'
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('users', function (Blueprint $table) {
            foreach (['branch_id', 'unit_id', 'employee_id'] as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropConstrainedForeignId($column);
                }
            }
            foreach (['locale', 'is_active', 'two_factor_secret', 'two_factor_confirmed_at', 'last_login_at', 'last_login_ip'] as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
            if (Schema::hasColumn('users', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
PHP;

foreach (array_reverse($tables) as $table) {
    if (! empty($table['alter'])) {
        continue;
    }
    $migration[] = "        Schema::dropIfExists('{$table['table']}');";
}

$migration[] = <<<'PHP'
        Schema::enableForeignKeyConstraints();
    }
};
PHP;

file_put_contents($root.'/database/migrations/2026_11_15_100000_create_mill_schema.php', implode("\n", $migration)."\n");

echo 'Generated '.count($created).' tables'.PHP_EOL;

function parseCol(string $spec): array
{
    $parts = preg_split('/\s+/', trim($spec));
    $type = array_shift($parts);
    $name = array_shift($parts);
    $col = [
        'type' => $type,
        'name' => $name,
        'nullable' => false,
        'unique' => false,
        'index' => false,
        'default' => null,
        'hasDefault' => false,
        'precision' => '18,3',
        'references' => null,
        'scale' => null,
    ];
    foreach ($parts as $part) {
        if ($part === 'nullable') {
            $col['nullable'] = true;
        } elseif ($part === 'unique') {
            $col['unique'] = true;
        } elseif ($part === 'index') {
            $col['index'] = true;
        } elseif (str_starts_with($part, 'default:')) {
            $col['hasDefault'] = true;
            $col['default'] = substr($part, 8);
        } elseif ($type === 'decimal' && str_contains($part, ',')) {
            $col['precision'] = $part;
        } elseif ($type === 'foreignId' && $col['references'] === null) {
            $col['references'] = $part;
        }
    }
    if ($type === 'decimal') {
        [$p, $s] = array_map('intval', explode(',', $col['precision']));
        $col['precision'] = (string) $p;
        $col['scale'] = $s;
    }

    return $col;
}

function emitColumn(array $col, array $created): string
{
    $name = $col['name'];
    $nullable = $col['nullable'] ? '->nullable()' : '';
    $unique = $col['unique'] ? '->unique()' : '';
    $index = (! $col['unique'] && $col['index']) ? '->index()' : '';
    $default = '';
    if ($col['hasDefault']) {
        $default = '->default('.phpDefault($col['default'], $col['type']).')';
    }

    if ($col['type'] === 'foreignId') {
        $ref = $col['references'] ?? Str::plural(Str::beforeLast($name, '_id'));
        if (! isset($created[$ref])) {
            return "\$table->unsignedBigInteger('{$name}'){$nullable}{$index};";
        }
        $nullOn = $col['nullable'] ? '->nullOnDelete()' : '->restrictOnDelete()';

        return "\$table->foreignId('{$name}'){$nullable}->constrained('{$ref}'){$nullOn}{$index};";
    }

    return match ($col['type']) {
        'string' => "\$table->string('{$name}'){$nullable}{$default}{$unique}{$index};",
        'text' => "\$table->text('{$name}'){$nullable}{$default};",
        'bool' => "\$table->boolean('{$name}'){$nullable}{$default};",
        'integer' => "\$table->integer('{$name}'){$nullable}{$default}{$index};",
        'unsignedInteger' => "\$table->unsignedInteger('{$name}'){$nullable}{$default}{$index};",
        'decimal' => "\$table->decimal('{$name}', {$col['precision']}, {$col['scale']}){$nullable}{$default};",
        'date' => "\$table->date('{$name}'){$nullable}{$index};",
        'datetime' => "\$table->dateTime('{$name}'){$nullable}{$index};",
        'time' => "\$table->time('{$name}'){$nullable};",
        'json' => "\$table->json('{$name}'){$nullable};",
        default => throw new RuntimeException('Unknown column type '.$col['type'].' for '.$name),
    };
}

function phpDefault(string $value, string $type): string
{
    if ($type === 'bool') {
        return in_array($value, ['1', 'true'], true) ? 'true' : 'false';
    }
    if (in_array($type, ['integer', 'unsignedInteger', 'decimal'], true)) {
        return $value;
    }
    if ($value === 'null') {
        return 'null';
    }

    return "'".addslashes($value)."'";
}

function writeModel(string $root, array $table, array $fkModels, bool $nobranch): void
{
    $model = $table['model'];
    $cols = array_map(parseCol(...), $table['cols']);
    $fillable = array_map(fn ($c) => $c['name'], $cols);
    if (! $nobranch && $table['table'] !== 'branches') {
        $fillable[] = 'branch_id';
    }
    $fillable = array_values(array_unique([...$fillable, 'created_by', 'updated_by']));

    $casts = [];
    foreach ($cols as $col) {
        $cast = match ($col['type']) {
            'bool' => 'boolean',
            'decimal' => 'decimal:'.$col['scale'],
            'json' => 'array',
            'date' => 'date',
            'datetime' => 'datetime',
            default => null,
        };
        if ($cast) {
            $casts[$col['name']] = $cast;
        }
    }

    $relations = [];
    $relationCols = $cols;
    if (! $nobranch && $table['table'] !== 'branches') {
        $relationCols[] = parseCol('foreignId branch_id branches nullable');
    }
    $relationCols[] = parseCol('foreignId created_by users nullable');
    $relationCols[] = parseCol('foreignId updated_by users nullable');

    foreach ($relationCols as $col) {
        if (! in_array($col['type'], ['foreignId'], true) && ! str_ends_with($col['name'], '_id') && $col['name'] !== 'assigned_to') {
            continue;
        }
        $column = $col['name'];
        if (! isset($fkModels[$column]) && $col['type'] !== 'foreignId') {
            continue;
        }
        $target = $fkModels[$column] ?? null;
        if ($column === 'parent_id') {
            $target = $model;
        }
        if ($target === null) {
            continue;
        }
        $method = relationMethod($column);
        $class = $target === 'User' ? '\\App\\Models\\User' : '\\App\\Models\\'.$target;
        $relations[] = <<<PHP

    public function {$method}(): BelongsTo
    {
        return \$this->belongsTo({$class}::class, '{$column}');
    }
PHP;
    }

    $uses = ['BelongsTo', 'HasFactory'];
    $traits = ['HasFactory'];
    $extra = '';
    if (! empty($table['slug'])) {
        $from = $table['slug'];
        $traits[] = 'HasUniversalSlug';
        $uses[] = 'ImranDev\\UniversalSlug\\Attributes\\Slug';
        $uses[] = 'ImranDev\\UniversalSlug\\Traits\\HasUniversalSlug';
        $extra = "\n#[Slug(from: '{$from}', to: 'slug', language: 'bn')]\n";
    }

    $fillableExport = exportArray($fillable);
    $castsExport = exportAssoc($casts);
    $useLines = '';
    foreach (array_unique($uses) as $use) {
        if ($use === 'BelongsTo') {
            $useLines .= "use Illuminate\\Database\\Eloquent\\Relations\\BelongsTo;\n";
        } elseif ($use === 'HasFactory') {
            $useLines .= "use Illuminate\\Database\\Eloquent\\Factories\\HasFactory;\n";
        } else {
            $useLines .= "use {$use};\n";
        }
    }

    $traitList = implode(', ', array_unique($traits));
    $relationCode = implode("\n", $relations);
    $tableName = $table['table'];

    $php = <<<PHP
<?php

declare(strict_types=1);

namespace App\\Models;

{$useLines}use App\\Models\\Concerns\\MillModel;
{$extra}
class {$model} extends MillModel
{
    use {$traitList};

    protected \$table = '{$tableName}';

    protected \$fillable = {$fillableExport};

    protected function casts(): array
    {
        return {$castsExport};
    }
{$relationCode}
}

PHP;

    file_put_contents($root.'/app/Models/'.$model.'.php', $php);
}

function writeFactory(string $root, array $table): void
{
    $model = $table['model'];
    $cols = array_map(parseCol(...), $table['cols']);
    $lines = [];
    foreach ($cols as $col) {
        if ($col['nullable'] && $col['type'] === 'foreignId') {
            continue;
        }
        if (in_array($col['name'], ['created_by', 'updated_by', 'approved_by'], true)) {
            continue;
        }
        $lines[] = "            '{$col['name']}' => ".factoryValue($col).',';
    }
    $body = implode("\n", $lines);
    $php = <<<PHP
<?php

declare(strict_types=1);

namespace Database\\Factories;

use App\\Models\\{$model};
use Illuminate\\Database\\Eloquent\\Factories\\Factory;

/**
 * @extends Factory<{$model}>
 */
class {$model}Factory extends Factory
{
    protected \$model = {$model}::class;

    public function definition(): array
    {
        return [
{$body}
        ];
    }
}

PHP;
    file_put_contents($root.'/database/factories/'.$model.'Factory.php', $php);
}

function factoryValue(array $col): string
{
    $name = $col['name'];
    if ($col['hasDefault'] && $col['type'] !== 'foreignId') {
        return phpDefault($col['default'], $col['type']);
    }

    return match ($col['type']) {
        'bool' => 'false',
        'integer', 'unsignedInteger' => '1',
        'decimal' => "'0'",
        'date' => 'now()->toDateString()',
        'datetime' => 'now()',
        'time' => "'08:00:00'",
        'json' => '[]',
        'text' => 'fake()->paragraph()',
        'foreignId' => '\\App\\Models\\'.(fkMap()[$name] ?? 'User').'::factory()',
        'string' => match (true) {
            str_contains($name, 'email') => 'fake()->unique()->safeEmail()',
            $name === 'code' || $name === 'number' || $name === 'lot_no' => 'fake()->unique()->bothify(\'??-#####\')',
            $name === 'slug' => 'fake()->unique()->slug()',
            $name === 'status' => "'draft'",
            $name === 'currency' => "'BDT'",
            default => 'fake()->words(3, true)',
        },
        default => "''",
    };
}

function writePolicy(string $root, array $table): void
{
    $model = $table['model'];
    $php = <<<PHP
<?php

declare(strict_types=1);

namespace App\\Policies;

use App\\Models\\{$model};
use App\\Models\\User;
use App\\Policies\\Concerns\\MillPolicy;

class {$model}Policy
{
    use MillPolicy;

    protected string \$ability = '{$model}';

    public function viewAny(User \$user): bool
    {
        return \$this->allow(\$user, 'view-any');
    }

    public function view(User \$user, {$model} \$record): bool
    {
        return \$this->allow(\$user, 'view', \$record);
    }

    public function create(User \$user): bool
    {
        return \$this->allow(\$user, 'create');
    }

    public function update(User \$user, {$model} \$record): bool
    {
        return \$this->allow(\$user, 'update', \$record);
    }

    public function delete(User \$user, {$model} \$record): bool
    {
        return \$this->allow(\$user, 'delete', \$record);
    }

    public function restore(User \$user, {$model} \$record): bool
    {
        return \$this->allow(\$user, 'restore', \$record);
    }

    public function forceDelete(User \$user, {$model} \$record): bool
    {
        return \$this->allow(\$user, 'force-delete', \$record);
    }
}

PHP;
    file_put_contents($root.'/app/Policies/'.$model.'Policy.php', $php);
}

function writeResource(string $root, array $table, int $sort): void
{
    $model = $table['model'];
    $group = $table['group'] ?? 'Master Data';
    $label = $table['label'] ?? Str::headline(Str::pluralStudly($model));
    $plural = Str::pluralStudly($model);
    $dir = $root.'/app/Filament/Resources/'.$model.'Resource/Pages';
    if (! is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $resource = <<<PHP
<?php

declare(strict_types=1);

namespace App\\Filament\\Resources;

use App\\Filament\\Resources\\{$model}Resource\\Pages;
use App\\Filament\\Support\\MillResource;
use App\\Models\\{$model};

class {$model}Resource extends MillResource
{
    protected static ?string \$model = {$model}::class;

    protected static ?string \$navigationGroup = '{$group}';

    protected static ?string \$navigationLabel = '{$label}';

    protected static ?int \$navigationSort = {$sort};

    public static function getPages(): array
    {
        return [
            'index' => Pages\\List{$plural}::route('/'),
            'create' => Pages\\Create{$model}::route('/create'),
            'view' => Pages\\View{$model}::route('/{record}'),
            'edit' => Pages\\Edit{$model}::route('/{record}/edit'),
        ];
    }
}

PHP;
    file_put_contents($root.'/app/Filament/Resources/'.$model.'Resource.php', $resource);

    $pages = [
        "List{$plural}" => 'ListRecords',
        "Create{$model}" => 'CreateRecord',
        "View{$model}" => 'ViewRecord',
        "Edit{$model}" => 'EditRecord',
    ];
    foreach ($pages as $class => $base) {
        $header = match ($base) {
            'ListRecords' => <<<'PHP'

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
PHP,
            'EditRecord' => <<<'PHP'

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
PHP,
            'ViewRecord' => <<<'PHP'

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
PHP,
            default => '',
        };
        $php = <<<PHP
<?php

declare(strict_types=1);

namespace App\\Filament\\Resources\\{$model}Resource\\Pages;

use App\\Filament\\Resources\\{$model}Resource;
use Filament\\Resources\\Pages\\{$base};

class {$class} extends {$base}
{
    protected static string \$resource = {$model}Resource::class;
{$header}
}

PHP;
        file_put_contents($dir.'/'.$class.'.php', $php);
    }
}

function relationMethod(string $column): string
{
    return match ($column) {
        'assigned_to' => 'assignee',
        'approved_by' => 'approver',
        'created_by' => 'creator',
        'updated_by' => 'editor',
        'parent_id' => 'parent',
        default => Str::camel(str_ends_with($column, '_id') ? substr($column, 0, -3) : $column),
    };
}

function exportArray(array $items): string
{
    $lines = array_map(fn ($item) => "        '{$item}',", $items);

    return "[\n".implode("\n", $lines)."\n    ]";
}

function exportAssoc(array $items): string
{
    if ($items === []) {
        return '[]';
    }
    $lines = [];
    foreach ($items as $key => $value) {
        $lines[] = "            '{$key}' => '{$value}',";
    }

    return "[\n".implode("\n", $lines)."\n        ]";
}

function fkMap(): array
{
    return [
        'company_id' => 'Company',
        'branch_id' => 'Branch',
        'unit_id' => 'Unit',
        'department_id' => 'Department',
        'section_id' => 'Section',
        'cost_centre_id' => 'CostCentre',
        'shift_id' => 'Shift',
        'holiday_id' => 'Holiday',
        'fiscal_year_id' => 'FiscalYear',
        'fiscal_period_id' => 'FiscalPeriod',
        'currency_id' => 'Currency',
        'party_id' => 'Party',
        'buyer_id' => 'Party',
        'supplier_id' => 'Party',
        'transporter_id' => 'Party',
        'bank_id' => 'Party',
        'agent_id' => 'Party',
        'subcontractor_id' => 'Party',
        'yarn_id' => 'Yarn',
        'warp_yarn_id' => 'Yarn',
        'weft_yarn_id' => 'Yarn',
        'yarn_lot_id' => 'YarnLot',
        'warp_lot_id' => 'YarnLot',
        'weft_lot_id' => 'YarnLot',
        'article_id' => 'FabricArticle',
        'chemical_id' => 'Chemical',
        'size_recipe_id' => 'SizeRecipe',
        'spare_id' => 'Spare',
        'packing_material_id' => 'PackingMaterial',
        'machine_id' => 'Machine',
        'loom_id' => 'Machine',
        'defect_id' => 'Defect',
        'warehouse_id' => 'Warehouse',
        'from_warehouse_id' => 'Warehouse',
        'to_warehouse_id' => 'Warehouse',
        'bin_id' => 'Bin',
        'uom_id' => 'UnitOfMeasure',
        'from_uom_id' => 'UnitOfMeasure',
        'to_uom_id' => 'UnitOfMeasure',
        'payment_term_id' => 'PaymentTerm',
        'incoterm_id' => 'Incoterm',
        'port_id' => 'Port',
        'loading_port_id' => 'Port',
        'discharge_port_id' => 'Port',
        'tax_rule_id' => 'TaxRule',
        'hs_code_id' => 'HsCode',
        'employee_id' => 'Employee',
        'operator_id' => 'Employee',
        'mechanic_id' => 'Employee',
        'inspector_id' => 'Employee',
        'user_id' => 'User',
        'assigned_to' => 'User',
        'approved_by' => 'User',
        'created_by' => 'User',
        'updated_by' => 'User',
        'sales_order_id' => 'SalesOrder',
        'sales_order_line_id' => 'SalesOrderLine',
        'quotation_id' => 'Quotation',
        'quotation_line_id' => 'QuotationLine',
        'purchase_order_id' => 'PurchaseOrder',
        'purchase_order_line_id' => 'PurchaseOrderLine',
        'purchase_requisition_id' => 'PurchaseRequisition',
        'job_card_id' => 'JobCard',
        'production_plan_id' => 'ProductionPlan',
        'stock_lot_id' => 'StockLot',
        'journal_id' => 'Journal',
        'account_id' => 'Account',
        'weaver_beam_id' => 'WeaverBeam',
        'sizing_batch_id' => 'SizingBatch',
        'warping_job_id' => 'WarpingJob',
        'section_beam_id' => 'SectionBeam',
        'fabric_roll_id' => 'FabricRoll',
        'goods_receipt_id' => 'GoodsReceipt',
        'dispatch_advice_id' => 'DispatchAdvice',
        'commercial_invoice_id' => 'CommercialInvoice',
        'gate_pass_id' => 'GatePass',
        'payroll_run_id' => 'PayrollRun',
        'lab_test_id' => 'LabTest',
        'test_package_id' => 'TestPackage',
        'asset_id' => 'Asset',
        'work_order_id' => 'WorkOrder',
        'issue_id' => 'Issue',
        'issue_rule_id' => 'IssueRule',
        'bank_account_id' => 'BankAccount',
        'gl_account_id' => 'Account',
        'letter_of_credit_id' => 'LetterOfCredit',
        'lc_id' => 'LetterOfCredit',
        'sales_contract_id' => 'SalesContract',
        'lead_id' => 'Lead',
        'inquiry_id' => 'Inquiry',
        'sample_request_id' => 'SampleRequest',
        'cost_sheet_id' => 'CostSheet',
        'proforma_invoice_id' => 'ProformaInvoice',
        'price_list_id' => 'PriceList',
        'bom_id' => 'BillOfMaterial',
        'rfq_id' => 'RequestForQuotation',
        'shipment_id' => 'Shipment',
        'finishing_batch_id' => 'FinishingBatch',
        'packing_list_id' => 'PackingList',
        'role_id' => 'Role',
        'permission_id' => 'Permission',
        'approval_flow_id' => 'ApprovalFlow',
        'approval_request_id' => 'ApprovalRequest',
        'recruitment_id' => 'Recruitment',
        'leave_type_id' => 'LeaveType',
        'wage_rate_id' => 'WageRate',
        'reed_id' => 'Reed',
        'heald_frame_id' => 'HealdFrame',
        'instrument_id' => 'Instrument',
        'pm_schedule_id' => 'PmSchedule',
        'fixed_asset_id' => 'FixedAsset',
        'budget_id' => 'Budget',
        'stock_count_id' => 'StockCount',
        'stock_transfer_id' => 'StockTransfer',
        'jobwork_challan_id' => 'JobworkChallan',
        'buyer_claim_id' => 'BuyerClaim',
        'supplier_claim_id' => 'SupplierClaim',
        'visitor_id' => 'Visitor',
        'loan_id' => 'Loan',
        'page_id' => 'Page',
        'certificate_id' => 'Certificate',
        'job_opening_id' => 'JobOpening',
        'drawing_job_id' => 'DrawingJob',
        'loom_setup_id' => 'LoomSetup',
        'loom_production_id' => 'LoomProduction',
        'beam_plan_id' => 'BeamPlan',
        'yarn_requirement_id' => 'YarnRequirement',
        'bill_of_entry_id' => 'BillOfEntry',
        'payment_id' => 'Payment',
        'receipt_id' => 'Receipt',
        'cheque_id' => 'Cheque',
        'order_cost_id' => 'OrderCost',
        'compliance_document_id' => 'ComplianceDocument',
        'grievance_id' => 'Grievance',
        'sample_id' => 'Sample',
        'follow_up_id' => 'FollowUp',
        'meeting_id' => 'Meeting',
        'visit_id' => 'Visit',
        'number_series_id' => 'NumberSeries',
        'approval_step_id' => 'ApprovalStep',
        'size_recipe_item_id' => 'SizeRecipeItem',
        'parent_id' => null,
    ];
}
