<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Account;
use App\Models\Attendance;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\BuyerClaim;
use App\Models\Chemical;
use App\Models\CommercialInvoice;
use App\Models\CommercialInvoiceLine;
use App\Models\Company;
use App\Models\ComplianceDocument;
use App\Models\CostCentre;
use App\Models\Currency;
use App\Models\Defect;
use App\Models\Department;
use App\Models\DispatchAdvice;
use App\Models\DispatchLine;
use App\Models\DocumentCheck;
use App\Models\DrawingJob;
use App\Models\Employee;
use App\Models\EtpLog;
use App\Models\FabricArticle;
use App\Models\FabricRoll;
use App\Models\FinishingBatch;
use App\Models\FiscalPeriod;
use App\Models\FiscalYear;
use App\Models\FollowUp;
use App\Models\GatePass;
use App\Models\GoodsReceipt;
use App\Models\HealdFrame;
use App\Models\Incoterm;
use App\Models\Inquiry;
use App\Models\JobCard;
use App\Models\JobworkChallan;
use App\Models\LabTest;
use App\Models\Lead;
use App\Models\LetterOfCredit;
use App\Models\LoomAllocation;
use App\Models\LoomProduction;
use App\Models\LoomSetup;
use App\Models\LoomStoppage;
use App\Models\Machine;
use App\Models\Meeting;
use App\Models\OrderCost;
use App\Models\PackingList;
use App\Models\PackingListLine;
use App\Models\Party;
use App\Models\PaymentTerm;
use App\Models\PmSchedule;
use App\Models\ProformaInvoice;
use App\Models\ProductionPlan;
use App\Models\PurchaseOrder;
use App\Models\Quotation;
use App\Models\Receipt;
use App\Models\Reed;
use App\Models\Role;
use App\Models\RollDefect;
use App\Models\SalesContract;
use App\Models\SalesOrder;
use App\Models\SalesOrderLine;
use App\Models\Sample;
use App\Models\SampleRequest;
use App\Models\SectionBeam;
use App\Models\Shift;
use App\Models\SizingBatch;
use App\Models\SizingLog;
use App\Models\Spare;
use App\Models\StockCount;
use App\Models\StockCountLine;
use App\Models\StockLot;
use App\Models\Unit;
use App\Models\User;
use App\Models\UtilityReading;
use App\Models\WageRate;
use App\Models\Warehouse;
use App\Models\WarpingCreelPosition;
use App\Models\WarpingJob;
use App\Models\WeaverBeam;
use App\Models\WorkOrder;
use App\Models\Yarn;
use App\Models\YarnLot;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Builds one working demo mill and walks a bale of poplin from inquiry to cash.
 */
class MillFlow
{
    public Branch $branch;

    public User $owner;

    /** @var array<string, int> */
    public array $accounts = [];

    public function __construct(
        private readonly WeavingMath $math,
        private readonly StockService $stock,
        private readonly PostingService $posting,
        private readonly PlanningService $planning,
        private readonly CostingService $costing,
        private readonly LandedCostService $landed,
        private readonly PayrollService $payroll,
        private readonly IssueEngine $issues,
        private readonly NumberSeriesService $numbers,
    ) {}

    /** @return array<string, mixed> */
    public static function demo(): array
    {
        return app(self::class)->run();
    }

    /** @return array<string, mixed> */
    public function run(): array
    {
        $this->foundation();
        $masters = $this->masters();
        $commerce = $this->commerce($masters);
        $production = $this->production($masters, $commerce);
        $this->exceptions($masters, $commerce, $production);
        $ledger = $this->ledger($masters, $commerce, $production);
        $opened = $this->issues->evaluate();

        return [
            'owner' => $this->owner,
            'branch' => $this->branch,
            'article' => $masters['article'],
            'roll' => $production['roll'],
            'order' => $commerce['order'],
            'invoice' => $ledger['invoice'],
            'warp_lot' => $production['warpLot'],
            'issues' => count($opened),
            'accounts' => $this->accounts,
        ];
    }

    private function foundation(): void
    {
        Currency::query()->create(['code' => 'BDT', 'name' => 'Taka', 'symbol' => '৳', 'decimal_places' => 2, 'is_base' => true]);
        $usd = Currency::query()->create(['code' => 'USD', 'name' => 'US Dollar', 'symbol' => '$', 'decimal_places' => 2, 'is_base' => false]);

        $company = Company::query()->create([
            'name' => 'Dhaka Woven Mills',
            'legal_name' => 'Dhaka Woven Mills Ltd',
            'country' => 'BD',
            'currency_code' => 'BDT',
            'timezone' => 'Asia/Dhaka',
            'address' => 'Konabari, Gazipur',
        ]);
        $this->branch = Branch::query()->create([
            'company_id' => $company->id,
            'code' => 'GAZ',
            'name' => 'Gazipur Unit',
            'finishing_enabled' => true,
            'is_active' => true,
        ]);

        $roleIds = [];
        foreach ($this->roleCatalog() as $slug => [$name, $panel, $twoFactor]) {
            $roleIds[$slug] = Role::query()->create([
                'name' => $name,
                'slug' => $slug,
                'panel' => $panel,
                'is_system' => true,
                'requires_two_factor' => $twoFactor,
            ])->id;
        }

        $this->owner = User::query()->create([
            'name' => 'Mill Owner',
            'email' => 'owner@mill.test',
            'password' => 'password',
            'branch_id' => $this->branch->id,
            'locale' => 'en',
            'is_active' => true,
        ]);
        $this->owner->roles()->attach($roleIds['owner'], ['branch_id' => $this->branch->id]);
        Auth::login($this->owner);

        foreach ($roleIds as $slug => $roleId) {
            if ($slug === 'owner') {
                continue;
            }
            $user = User::query()->create([
                'name' => str($slug)->headline()->toString(),
                'email' => $slug.'@mill.test',
                'password' => 'password',
                'branch_id' => $this->branch->id,
                'locale' => 'en',
                'is_active' => true,
                'two_factor_secret' => in_array($slug, ['accountant', 'accounts-manager', 'auditor'], true) ? 'JBSWY3DPEHPK3PXP' : null,
                'two_factor_confirmed_at' => in_array($slug, ['accountant', 'accounts-manager', 'auditor'], true) ? now() : null,
            ]);
            $user->roles()->attach($roleId, ['branch_id' => $this->branch->id]);
        }

        $year = FiscalYear::query()->create([
            'name' => 'FY '.$this->yearLabel(),
            'starts_on' => now()->month >= 7 ? now()->startOfYear()->month(7)->startOfMonth()->toDateString() : now()->subYear()->startOfYear()->month(7)->startOfMonth()->toDateString(),
            'ends_on' => now()->month >= 7 ? now()->addYear()->startOfYear()->month(6)->endOfMonth()->toDateString() : now()->startOfYear()->month(6)->endOfMonth()->toDateString(),
            'is_closed' => false,
            'branch_id' => $this->branch->id,
        ]);
        FiscalPeriod::query()->create([
            'fiscal_year_id' => $year->id,
            'name' => now()->format('F Y'),
            'starts_on' => now()->startOfMonth()->toDateString(),
            'ends_on' => now()->endOfMonth()->toDateString(),
            'is_locked' => false,
            'branch_id' => $this->branch->id,
        ]);

        foreach ([
            '1000' => ['Cash', 'asset'],
            '1100' => ['Bank', 'asset'],
            '1200' => ['Accounts receivable', 'asset'],
            '1300' => ['Yarn inventory', 'asset'],
            '1310' => ['Chemical inventory', 'asset'],
            '1320' => ['Grey fabric', 'asset'],
            '1330' => ['Finished fabric', 'asset'],
            '2000' => ['Accounts payable', 'liability'],
            '2400' => ['Wages payable', 'liability'],
            '3000' => ['Capital', 'equity'],
            '4000' => ['Local sales', 'income'],
            '4100' => ['Export sales', 'income'],
            '5000' => ['Cost of goods sold', 'expense'],
            '6100' => ['Wages', 'expense'],
        ] as $code => [$name, $type]) {
            $this->accounts[$code] = Account::query()->create([
                'code' => $code,
                'name' => $name,
                'account_type' => $type,
                'is_postable' => true,
                'is_active' => true,
            ])->id;
        }

        BankAccount::query()->create([
            'name' => 'Sonali current',
            'account_no' => '00112233',
            'bank_name' => 'Sonali Bank',
            'currency_id' => $usd->id,
            'gl_account_id' => $this->accounts['1100'],
            'balance' => 0,
            'branch_id' => $this->branch->id,
        ]);
    }

    /** @return array<string, mixed> */
    private function masters(): array
    {
        $b = $this->branch->id;
        $unit = Unit::query()->create(['code' => 'U1', 'name' => 'Weaving Unit 1', 'loom_count' => 48, 'is_active' => true, 'branch_id' => $b]);
        $dept = Department::query()->create(['code' => 'WEV', 'name' => 'Weaving', 'unit_id' => $unit->id, 'branch_id' => $b]);
        CostCentre::query()->create(['code' => 'WEV-1', 'name' => 'Weaving section', 'type' => 'section', 'department_id' => $dept->id, 'branch_id' => $b]);
        $shift = Shift::query()->create(['code' => 'A', 'name' => 'Shift A', 'starts_at' => '06:00', 'ends_at' => '14:00', 'branch_id' => $b]);
        $yarnStore = Warehouse::query()->create(['code' => 'YS', 'name' => 'Yarn store', 'store_type' => 'yarn', 'unit_id' => $unit->id, 'branch_id' => $b]);
        Warehouse::query()->create(['code' => 'GS', 'name' => 'Grey store', 'store_type' => 'grey', 'unit_id' => $unit->id, 'branch_id' => $b]);

        $warpYarn = Yarn::query()->create([
            'code' => 'Y40C', 'name' => '40s combed cotton', 'count_value' => 40, 'count_system' => 'Ne',
            'yarn_type' => 'combed', 'cotton_pct' => 100, 'twist_direction' => 'Z', 'standard_cost' => 220,
            'reorder_kg' => 10, 'branch_id' => $b,
        ]);
        Yarn::query()->create([
            'code' => 'Y30K', 'name' => '30s carded', 'count_value' => 30, 'count_system' => 'Ne',
            'yarn_type' => 'carded', 'reorder_kg' => 500, 'branch_id' => $b,
        ]);
        $article = FabricArticle::query()->create([
            'code' => 'POP-133',
            'name' => '40x40 133x72 Poplin',
            'warp_yarn_id' => $warpYarn->id,
            'weft_yarn_id' => $warpYarn->id,
            'epi' => 133,
            'ppi' => 72,
            'weave' => 'poplin',
            'grey_width_cm' => 160,
            'finished_width_cm' => 147,
            'composition' => '100% cotton',
            'finish_type' => 'ready for dyeing',
            'end_use' => 'shirting',
            'reed_count' => 66.5,
            'ends_per_dent' => 2,
            'selvedge_ends' => 0,
            'crimp_warp_pct' => 8,
            'crimp_weft_pct' => 6,
            'expected_efficiency' => 85,
            'is_public' => true,
            'branch_id' => $b,
        ]);
        $sheet = $this->math->technicalSheet($article);
        $article->update([
            'total_ends' => $sheet['total_ends'],
            'warp_kg_per_100m' => $sheet['warp_kg_per_100m'],
            'weft_kg_per_100m' => $sheet['weft_kg_per_100m'],
            'calculated_gsm' => $sheet['calculated_gsm'],
            'metres_per_loom_shift' => $sheet['metres_per_loom_shift'],
        ]);

        $buyer = Party::query()->create([
            'code' => 'BUY-01', 'name' => 'Nordic Shirt Co', 'type' => 'buyer', 'country' => 'SE',
            'currency_code' => 'USD', 'credit_limit' => 1000, 'email' => 'buyer@mill.test', 'branch_id' => $b,
        ]);
        $supplier = Party::query()->create([
            'code' => 'SUP-01', 'name' => 'Square Spinning', 'type' => 'supplier', 'country' => 'BD', 'email' => 'supplier@mill.test', 'branch_id' => $b,
        ]);
        $jobber = Party::query()->create([
            'code' => 'DYE-01', 'name' => 'Gazipur Dye Works', 'type' => 'subcontractor', 'branch_id' => $b,
        ]);
        $loom = Machine::query()->create([
            'code' => 'L-14', 'name' => 'Air-jet 14', 'machine_type' => 'loom', 'make' => 'Toyota',
            'model_name' => 'JAT810', 'shed_mechanism' => 'cam', 'rpm' => 600, 'reed_width_cm' => 190,
            'selectors' => 4, 'unit_id' => $unit->id, 'status' => 'running', 'is_public' => true, 'branch_id' => $b,
        ]);
        $warper = Machine::query()->create(['code' => 'W-01', 'name' => 'Direct warper', 'machine_type' => 'warping', 'branch_id' => $b]);
        $sizer = Machine::query()->create(['code' => 'S-01', 'name' => 'Sizing machine', 'machine_type' => 'sizing', 'branch_id' => $b]);
        $operator = Employee::query()->create([
            'code' => 'E-014', 'name' => 'Karim Mia', 'employment_type' => 'worker', 'department_id' => $dept->id,
            'designation' => 'Loom operator', 'skill_level' => 3, 'is_active' => true, 'branch_id' => $b,
        ]);
        foreach (['E-101', 'E-102', 'E-103'] as $code) {
            Employee::query()->create(['code' => $code, 'name' => 'Absentee '.$code, 'employment_type' => 'worker', 'is_active' => true, 'branch_id' => $b]);
        }
        Defect::query()->create(['code' => 'WB', 'name' => 'Warp broken', 'name_bn' => 'টানা ছিঁড়া', 'system' => 'both', 'cause_category' => 'weaving']);
        Chemical::query()->create(['code' => 'PVA', 'name' => 'PVA size', 'kind' => 'size', 'standard_cost' => 180, 'branch_id' => $b]);
        Spare::query()->create(['code' => 'NZ-01', 'name' => 'Main nozzle', 'criticality' => 'A', 'min_qty' => 2, 'branch_id' => $b]);
        PaymentTerm::query()->create(['code' => 'LC60', 'name' => 'LC at sight 60 days', 'days' => 60]);
        Incoterm::query()->create(['code' => 'FOB', 'name' => 'Free on board']);
        WageRate::query()->create(['article_id' => $article->id, 'basis' => 'per_metre', 'rate' => 2.5, 'effective_from' => '2026-07-01', 'branch_id' => $b]);

        return compact('unit', 'dept', 'shift', 'yarnStore', 'warpYarn', 'article', 'buyer', 'supplier', 'jobber', 'loom', 'warper', 'sizer', 'operator');
    }

    /** @param  array<string, mixed>  $m */
    private function commerce(array $m): array
    {
        $b = $this->branch->id;
        $buyer = $m['buyer'];
        $article = $m['article'];
        $lead = Lead::query()->create(['number' => $this->doc(Lead::class), 'status' => 'qualified', 'company_name' => 'Nordic Shirt Co', 'source' => 'website', 'branch_id' => $b]);
        $inquiry = Inquiry::query()->create(['number' => $this->doc(Inquiry::class), 'status' => 'open', 'lead_id' => $lead->id, 'buyer_id' => $buyer->id, 'subject' => '133x72 poplin', 'branch_id' => $b]);
        FollowUp::query()->create(['inquiry_id' => $inquiry->id, 'due_on' => now()->toDateString(), 'channel' => 'email', 'notes' => 'Send handloom', 'branch_id' => $b]);
        Meeting::query()->create(['buyer_id' => $buyer->id, 'met_at' => now(), 'subject' => 'Shirting range', 'branch_id' => $b]);
        $request = SampleRequest::query()->create(['number' => $this->doc(SampleRequest::class), 'status' => 'approved', 'buyer_id' => $buyer->id, 'inquiry_id' => $inquiry->id, 'article_id' => $article->id, 'sample_type' => 'handloom', 'quantity_m' => 5, 'branch_id' => $b]);
        Sample::query()->create(['number' => $this->doc(Sample::class), 'status' => 'approved', 'sample_request_id' => $request->id, 'article_id' => $article->id, 'development_cost' => 1500, 'buyer_comment' => 'Approved', 'branch_id' => $b]);
        $sheet = $this->costing->costSheet($article, '220', '12');
        $quote = Quotation::query()->create(['number' => $this->doc(Quotation::class), 'status' => 'approved', 'buyer_id' => $buyer->id, 'cost_sheet_id' => $sheet->id, 'quote_date' => now()->toDateString(), 'total' => 80000, 'branch_id' => $b]);
        $pi = ProformaInvoice::query()->create(['number' => $this->doc(ProformaInvoice::class), 'status' => 'approved', 'quotation_id' => $quote->id, 'buyer_id' => $buyer->id, 'pi_date' => now()->toDateString(), 'total' => 80000, 'branch_id' => $b]);
        $contract = SalesContract::query()->create(['number' => $this->doc(SalesContract::class), 'status' => 'approved', 'buyer_id' => $buyer->id, 'proforma_invoice_id' => $pi->id, 'contract_no' => 'SC-133', 'contract_date' => now()->toDateString(), 'amount' => 800, 'currency_code' => 'USD', 'branch_id' => $b]);
        $lc = LetterOfCredit::query()->create([
            'number' => $this->doc(LetterOfCredit::class), 'status' => 'open', 'lc_type' => 'export',
            'buyer_id' => $buyer->id, 'sales_contract_id' => $contract->id, 'lc_number' => 'LC-88421',
            'amount' => 800, 'utilised' => 200, 'currency_code' => 'USD',
            'expiry_date' => now()->addDays(10)->toDateString(), 'shipment_date' => now()->addDays(7)->toDateString(),
            'branch_id' => $b,
        ]);
        LetterOfCredit::query()->create([
            'number' => $this->doc(LetterOfCredit::class), 'status' => 'open', 'lc_type' => 'btb',
            'amount' => 100, 'utilised' => 95, 'currency_code' => 'USD',
            'expiry_date' => now()->addYear()->toDateString(), 'branch_id' => $b,
        ]);
        $order = SalesOrder::query()->create([
            'number' => $this->doc(SalesOrder::class), 'status' => 'approved', 'buyer_id' => $buyer->id,
            'sales_contract_id' => $contract->id, 'lc_id' => $lc->id,
            'order_date' => now()->subDays(20)->toDateString(), 'delivery_date' => now()->subDay()->toDateString(),
            'total' => 80000, 'margin_pct' => 12, 'branch_id' => $b,
        ]);
        $line = SalesOrderLine::query()->create([
            'sales_order_id' => $order->id, 'article_id' => $article->id, 'shade' => 'optic white',
            'width_cm' => 147, 'quantity' => 1000, 'uom' => 'm', 'rate' => 80, 'amount' => 80000,
            'delivery_date' => now()->subDay()->toDateString(), 'produced_qty' => 0, 'branch_id' => $b,
        ]);
        $plan = ProductionPlan::query()->create([
            'number' => $this->doc(ProductionPlan::class), 'status' => 'released', 'sales_order_id' => $order->id,
            'start_date' => now()->subDays(10)->toDateString(), 'end_date' => now()->addDays(5)->toDateString(), 'branch_id' => $b,
        ]);
        $this->planning->yarnRequirement($plan->id, $article, '1000');
        $order->update(['feasibility' => $this->planning->feasibility($order->fresh())]);

        $po = PurchaseOrder::query()->create([
            'number' => $this->doc(PurchaseOrder::class), 'status' => 'approved', 'supplier_id' => $m['supplier']->id,
            'order_date' => now()->subDays(15)->toDateString(), 'delivery_date' => now()->subDays(2)->toDateString(),
            'total' => 30800, 'is_import' => false, 'branch_id' => $b,
        ]);

        return compact('order', 'line', 'plan', 'po', 'lc', 'inquiry');
    }

    /** @param  array<string, mixed>  $m
     * @param  array<string, mixed>  $c
     */
    private function production(array $m, array $c): array
    {
        $b = $this->branch->id;
        $article = $m['article'];
        $warpLot = YarnLot::query()->create(['yarn_id' => $m['warpYarn']->id, 'supplier_id' => $m['supplier']->id, 'lot_no' => 'WL-19', 'qty_kg' => 100, 'unit_cost' => 220, 'status' => 'released', 'received_on' => now()->toDateString(), 'branch_id' => $b]);
        $weftLot = YarnLot::query()->create(['yarn_id' => $m['warpYarn']->id, 'supplier_id' => $m['supplier']->id, 'lot_no' => 'WF-07', 'qty_kg' => 40, 'unit_cost' => 220, 'status' => 'released', 'received_on' => now()->toDateString(), 'branch_id' => $b]);
        $warpStock = $this->stock->receive([
            'item_type' => 'yarn', 'item_id' => $m['warpYarn']->id, 'lot_no' => 'WL-19', 'warehouse_id' => $m['yarnStore']->id,
            'supplier_id' => $m['supplier']->id, 'yarn_lot_id' => $warpLot->id, 'qty' => '100', 'unit_cost' => '220',
            'status' => 'released', 'branch_id' => $b,
        ]);
        $weftStock = $this->stock->receive([
            'item_type' => 'yarn', 'item_id' => $m['warpYarn']->id, 'lot_no' => 'WF-07', 'warehouse_id' => $m['yarnStore']->id,
            'supplier_id' => $m['supplier']->id, 'yarn_lot_id' => $weftLot->id, 'qty' => '40', 'unit_cost' => '220',
            'status' => 'released', 'branch_id' => $b,
        ]);

        $warpCard = JobCard::query()->create(['number' => $this->doc(JobCard::class), 'status' => 'running', 'production_plan_id' => $c['plan']->id, 'sales_order_line_id' => $c['line']->id, 'article_id' => $article->id, 'stage' => 'warping', 'qty_m' => 1000, 'barcode' => 'JC-WARP', 'branch_id' => $b]);
        $weaveCard = JobCard::query()->create(['number' => $this->doc(JobCard::class), 'status' => 'running', 'production_plan_id' => $c['plan']->id, 'sales_order_line_id' => $c['line']->id, 'article_id' => $article->id, 'stage' => 'weaving', 'qty_m' => 1000, 'barcode' => 'JC-WEAVE', 'branch_id' => $b]);
        $this->stock->issue($warpStock, '20', ['job_card_id' => $warpCard->id, 'move_type' => 'issue', 'narration' => 'Warp issue']);
        $this->stock->issue($weftStock, '8', ['job_card_id' => $weaveCard->id, 'move_type' => 'issue', 'narration' => 'Weft issue']);

        $warping = WarpingJob::query()->create([
            'number' => $this->doc(WarpingJob::class), 'status' => 'completed', 'job_card_id' => $warpCard->id,
            'article_id' => $article->id, 'yarn_id' => $m['warpYarn']->id, 'yarn_lot_id' => $warpLot->id,
            'machine_id' => $m['warper']->id, 'operator_id' => $m['operator']->id, 'shift_id' => $m['shift']->id,
            'ends' => $article->total_ends, 'beam_length_m' => 1200, 'yarn_issued_kg' => 20, 'yarn_consumed_kg' => 19.4,
            'soft_waste_kg' => 0.4, 'hard_waste_kg' => 0.2, 'branch_id' => $b,
        ]);
        WarpingCreelPosition::query()->create(['warping_job_id' => $warping->id, 'position_no' => 1, 'yarn_lot_id' => $warpLot->id, 'cone_barcode' => 'CONE-1', 'branch_id' => $b]);
        $section = SectionBeam::query()->create(['number' => 'SB-19', 'warping_job_id' => $warping->id, 'ends' => $article->total_ends, 'length_m' => 1200, 'net_kg' => 19.4, 'status' => 'at_sizing', 'branch_id' => $b]);
        $sizing = SizingBatch::query()->create([
            'number' => $this->doc(SizingBatch::class), 'status' => 'completed', 'machine_id' => $m['sizer']->id,
            'pickup_target' => 10, 'pickup_actual' => 14, 'moisture' => 7.5, 'stretch_pct' => 1.1, 'chemical_kg' => 2.2, 'cost' => 400, 'branch_id' => $b,
        ]);
        SizingLog::query()->create(['sizing_batch_id' => $sizing->id, 'section_beam_id' => $section->id, 'beam_no' => 'SB-19', 'warp_length_m' => 1200, 'size_box_temp' => 92, 'squeeze_pressure' => 14, 'branch_id' => $b]);
        $onLoom = WeaverBeam::query()->create(['number' => 'WB-14', 'sizing_batch_id' => $sizing->id, 'article_id' => $article->id, 'length_m' => 1100, 'leftover_m' => 40, 'ends' => $article->total_ends, 'size_addon_pct' => 14, 'position' => 'on_loom', 'branch_id' => $b]);
        WeaverBeam::query()->create(['number' => 'WB-LEFT-1', 'article_id' => $article->id, 'length_m' => 300, 'leftover_m' => 300, 'position' => 'store', 'branch_id' => $b]);
        WeaverBeam::query()->create(['number' => 'WB-LEFT-2', 'article_id' => $article->id, 'length_m' => 320, 'leftover_m' => 320, 'position' => 'store', 'branch_id' => $b]);
        $reed = Reed::query()->create(['code' => 'RD-66', 'reed_count' => 66.5, 'reed_space_cm' => 168, 'loom_id' => $m['loom']->id, 'branch_id' => $b]);
        $heald = HealdFrame::query()->create(['code' => 'HF-1', 'frame_no' => 1, 'wire_count' => 4200, 'loom_id' => $m['loom']->id, 'branch_id' => $b]);
        DrawingJob::query()->create(['number' => $this->doc(DrawingJob::class), 'status' => 'completed', 'weaver_beam_id' => $onLoom->id, 'article_id' => $article->id, 'reed_id' => $reed->id, 'heald_frame_id' => $heald->id, 'operator_id' => $m['operator']->id, 'method' => 'fresh', 'branch_id' => $b]);
        LoomAllocation::query()->create(['production_plan_id' => $c['plan']->id, 'loom_id' => $m['loom']->id, 'article_id' => $article->id, 'start_date' => now()->subDays(3)->toDateString(), 'planned_metres' => 1000, 'status' => 'running', 'branch_id' => $b]);
        foreach ([0, 1] as $n) {
            LoomSetup::query()->create(['loom_id' => $m['loom']->id, 'article_id' => $article->id, 'weaver_beam_id' => $onLoom->id, 'reed_id' => $reed->id, 'speed' => 600, 'setup_minutes' => 70, 'operator_id' => $m['operator']->id, 'started_at' => now()->subDays($n + 1), 'branch_id' => $b]);
        }

        $metresEach = $this->math->metresFromPicks(230400, '72');
        $efficiency = $this->math->efficiency(230400, 600, 480);
        foreach ([2, 1, 0] as $index => $daysAgo) {
            LoomProduction::query()->create([
                'loom_id' => $m['loom']->id, 'shift_id' => $m['shift']->id, 'operator_id' => $m['operator']->id,
                'article_id' => $article->id, 'job_card_id' => $weaveCard->id, 'weaver_beam_id' => $onLoom->id,
                'production_date' => now()->subDays($daysAgo)->toDateString(), 'picks' => 230400, 'rpm' => 600,
                'minutes' => 480, 'efficiency' => $efficiency, 'metres' => $metresEach,
                'warp_breaks' => $index === 0 ? 12 : 1, 'weft_breaks' => 4, 'source' => 'kiosk', 'branch_id' => $b,
            ]);
        }
        LoomStoppage::query()->create(['loom_id' => $m['loom']->id, 'shift_id' => $m['shift']->id, 'reason_code' => 'unspecified', 'reason_bn' => 'কারণ নেই', 'minutes' => 40, 'started_at' => now()->subHours(3), 'branch_id' => $b]);
        LoomStoppage::query()->create(['loom_id' => $m['loom']->id, 'shift_id' => $m['shift']->id, 'reason_code' => 'warp_out', 'reason_bn' => 'টানা শেষ', 'minutes' => 150, 'started_at' => now()->subHours(5), 'branch_id' => $b]);

        $rollMetres = bcmul($metresEach, '3', 3);
        $points = $this->math->pointsPerHundredSqYd('18', $rollMetres, '160');
        $roll = FabricRoll::query()->create([
            'number' => 'RL-1401', 'article_id' => $article->id, 'loom_id' => $m['loom']->id,
            'operator_id' => $m['operator']->id, 'shift_id' => $m['shift']->id, 'weaver_beam_id' => $onLoom->id,
            'sizing_batch_id' => $sizing->id, 'warp_lot_id' => $warpLot->id, 'weft_lot_id' => $weftLot->id,
            'job_card_id' => $weaveCard->id, 'length_m' => $rollMetres, 'weight_kg' => 32, 'grey_width_cm' => 160,
            'gsm' => $article->calculated_gsm, 'grade' => 'B', 'points' => $points, 'inspection_system' => '4-point',
            'status' => 'grey', 'doffed_at' => now(), 'barcode' => 'RL-1401', 'branch_id' => $b,
        ]);
        RollDefect::query()->create([
            'fabric_roll_id' => $roll->id, 'defect_id' => Defect::query()->where('code', 'WB')->value('id'),
            'position_m' => 12, 'length_inch' => 4, 'points' => $this->math->defectPoints('4'), 'human_confirmed' => true, 'branch_id' => $b,
        ]);

        $finish = FinishingBatch::query()->create([
            'number' => $this->doc(FinishingBatch::class), 'status' => 'received', 'article_id' => $article->id,
            'subcontractor_id' => $m['jobber']->id, 'process_route' => 'jobwork', 'shade' => 'optic white',
            'grey_m' => $rollMetres, 'finished_m' => $rollMetres, 'process_loss_pct' => 8, 'rate_per_m' => 6,
            'cost' => 1500, 'is_reprocess' => true, 'branch_id' => $b,
        ]);
        JobworkChallan::query()->create(['number' => $this->doc(JobworkChallan::class), 'status' => 'returned', 'subcontractor_id' => $m['jobber']->id, 'finishing_batch_id' => $finish->id, 'direction' => 'in', 'metres' => $rollMetres, 'challan_date' => now()->toDateString(), 'branch_id' => $b]);
        $packing = PackingList::query()->create(['number' => $this->doc(PackingList::class), 'status' => 'ready', 'sales_order_id' => $c['order']->id, 'cartons' => 1, 'net_kg' => 30, 'gross_kg' => 32, 'total_metres' => $rollMetres, 'branch_id' => $b]);
        PackingListLine::query()->create(['packing_list_id' => $packing->id, 'fabric_roll_id' => $roll->id, 'carton_no' => 'C1', 'metres' => $rollMetres, 'net_kg' => 30, 'gross_kg' => 32, 'branch_id' => $b]);

        return compact('warpLot', 'weftLot', 'warpStock', 'roll', 'rollMetres', 'onLoom', 'sizing');
    }

    /** @param  array<string, mixed>  $m @param  array<string, mixed>  $c @param  array<string, mixed>  $p */
    private function exceptions(array $m, array $c, array $p): void
    {
        $b = $this->branch->id;
        $held = GoodsReceipt::query()->create([
            'number' => $this->doc(GoodsReceipt::class), 'status' => 'received', 'purchase_order_id' => $c['po']->id,
            'warehouse_id' => $m['yarnStore']->id, 'qc_status' => 'quarantine', 'received_at' => now()->subDays(3), 'branch_id' => $b,
        ]);
        GoodsReceipt::query()->whereKey($held->id)->update(['created_at' => now()->subDays(3)]);

        $chemical = Chemical::query()->where('code', 'PVA')->first();
        $this->stock->receive([
            'item_type' => 'chemical', 'item_id' => $chemical->id, 'lot_no' => 'PVA-EXP',
            'warehouse_id' => $m['yarnStore']->id, 'qty' => '25', 'unit_cost' => '180',
            'expiry_date' => now()->addDays(10)->toDateString(), 'branch_id' => $b,
        ]);
        $count = StockCount::query()->create(['number' => $this->doc(StockCount::class), 'status' => 'posted', 'warehouse_id' => $m['yarnStore']->id, 'count_date' => now()->toDateString(), 'branch_id' => $b]);
        StockCountLine::query()->create(['stock_count_id' => $count->id, 'stock_lot_id' => $p['warpStock']->id, 'book_qty' => 80, 'physical_qty' => 74, 'variance_qty' => -6, 'branch_id' => $b]);
        LabTest::query()->create(['number' => $this->doc(LabTest::class), 'status' => 'completed', 'sample_type' => 'yarn', 'related_type' => YarnLot::class, 'related_id' => $p['warpLot']->id, 'result' => 'fail', 'tested_at' => now(), 'branch_id' => $b]);
        BuyerClaim::query()->create(['number' => $this->doc(BuyerClaim::class), 'status' => 'open', 'buyer_id' => $m['buyer']->id, 'fabric_roll_id' => $p['roll']->id, 'reason' => 'Shade band', 'claimed_m' => 20, 'amount' => 1600, 'branch_id' => $b]);
        PmSchedule::query()->create(['machine_id' => $m['loom']->id, 'frequency' => 'weekly', 'next_due' => now()->subDay()->toDateString(), 'is_active' => true, 'branch_id' => $b]);
        foreach (['WO-1', 'WO-2', 'WO-3'] as $ignored) {
            WorkOrder::query()->create([
                'number' => $this->doc(WorkOrder::class), 'status' => 'closed', 'machine_id' => $m['loom']->id,
                'loom_id' => $m['loom']->id, 'work_type' => 'breakdown', 'downtime_minutes' => 40,
                'root_cause' => 'Nozzle choke', 'branch_id' => $b,
            ]);
        }
        UtilityReading::query()->create(['reading_date' => now()->toDateString(), 'utility' => 'power', 'reading_value' => 1800, 'uom' => 'kWh', 'cost' => 900, 'metres_produced' => 200, 'cost_per_metre' => 4.5, 'branch_id' => $b]);
        UtilityReading::query()->create(['reading_date' => now()->toDateString(), 'utility' => 'air', 'reading_value' => 3.2, 'uom' => 'bar', 'branch_id' => $b]);
        EtpLog::query()->create(['logged_at' => now(), 'inlet_ph' => 8, 'outlet_ph' => 9.4, 'outlet_bod' => 80, 'within_limit' => false, 'branch_id' => $b]);
        DocumentCheck::query()->create(['lc_id' => $c['lc']->id, 'document_name' => 'Bill of lading', 'is_present' => true, 'matches_lc' => false, 'discrepancy' => 'Port of discharge differs', 'branch_id' => $b]);
        OrderCost::query()->create([
            'sales_order_id' => $c['order']->id, 'article_id' => $m['article']->id, 'metres' => 20,
            'total' => 2000, 'revenue' => 1000, 'profit' => -1000, 'cost_per_metre' => 100, 'branch_id' => $b,
        ]);
        Attendance::query()->create(['employee_id' => $m['operator']->id, 'work_date' => now()->toDateString(), 'shift_id' => $m['shift']->id, 'ot_minutes' => 700, 'status' => 'present', 'source' => 'device', 'branch_id' => $b]);
        foreach (Employee::query()->where('code', 'like', 'E-10%')->get() as $employee) {
            Attendance::query()->create(['employee_id' => $employee->id, 'work_date' => now()->toDateString(), 'shift_id' => $m['shift']->id, 'status' => 'absent', 'branch_id' => $b]);
        }
        ComplianceDocument::query()->create(['name' => 'Boiler certificate', 'category' => 'licence', 'expires_on' => now()->addDays(12)->toDateString(), 'branch_id' => $b]);
        DB::table('attendance_devices')->insert([
            'name' => 'Gate ZKTeco', 'provider' => 'zkteco', 'status' => 'offline', 'port' => 4370,
            'branch_id' => $b, 'created_at' => now()->subHours(3), 'updated_at' => now()->subHours(3),
        ]);
        $this->landed->store($c['po']->id, $p['warpLot']->id, [
            'invoice' => 20000, 'freight' => 800, 'insurance' => 200, 'duty' => 0, 'port' => 300, 'cf' => 500, 'qty' => 100,
        ], $b);
    }

    /** @param  array<string, mixed>  $m @param  array<string, mixed>  $c @param  array<string, mixed>  $p */
    private function ledger(array $m, array $c, array $p): array
    {
        $b = $this->branch->id;
        $grn = GoodsReceipt::query()->create([
            'number' => $this->doc(GoodsReceipt::class), 'status' => 'released', 'purchase_order_id' => $c['po']->id,
            'warehouse_id' => $m['yarnStore']->id, 'qc_status' => 'released', 'received_at' => now(), 'branch_id' => $b,
        ]);
        $yarnValue = '30800.00';
        $this->posting->post($grn, [
            ['account_id' => $this->accounts['1300'], 'debit' => $yarnValue, 'narration' => 'Yarn GRN'],
            ['account_id' => $this->accounts['2000'], 'credit' => $yarnValue, 'narration' => 'Yarn GRN'],
        ], ['purpose' => 'grn', 'narration' => 'Yarn received']);

        $issued = '6160.00';
        $this->posting->post($grn, [
            ['account_id' => $this->accounts['5000'], 'debit' => $issued, 'narration' => 'Yarn to production'],
            ['account_id' => $this->accounts['1300'], 'credit' => $issued, 'narration' => 'Yarn to production'],
        ], ['purpose' => 'issue', 'narration' => 'Yarn issued to job cards']);

        $advice = DispatchAdvice::query()->create([
            'number' => $this->doc(DispatchAdvice::class), 'status' => 'dispatched', 'sales_order_id' => $c['order']->id,
            'buyer_id' => $m['buyer']->id, 'dispatch_date' => now()->toDateString(), 'vehicle_no' => 'DHA-11-1234',
            'metres' => $p['rollMetres'], 'branch_id' => $b,
        ]);
        DispatchLine::query()->create(['dispatch_advice_id' => $advice->id, 'sales_order_line_id' => $c['line']->id, 'fabric_roll_id' => $p['roll']->id, 'metres' => $p['rollMetres'], 'branch_id' => $b]);
        $amount = bcmul((string) $p['rollMetres'], '80', 2);
        $invoice = CommercialInvoice::query()->create([
            'number' => $this->doc(CommercialInvoice::class), 'status' => 'posted', 'sales_order_id' => $c['order']->id,
            'dispatch_advice_id' => $advice->id, 'buyer_id' => $m['buyer']->id, 'invoice_date' => now()->toDateString(),
            'amount' => $amount, 'vat' => 0, 'total' => $amount, 'is_export' => true, 'branch_id' => $b,
        ]);
        CommercialInvoiceLine::query()->create([
            'commercial_invoice_id' => $invoice->id, 'article_id' => $m['article']->id, 'description' => 'Poplin grey',
            'quantity' => $p['rollMetres'], 'uom' => 'm', 'rate' => 80, 'amount' => $amount, 'branch_id' => $b,
        ]);
        $this->posting->post($invoice, [
            ['account_id' => $this->accounts['1200'], 'debit' => $amount],
            ['account_id' => $this->accounts['4100'], 'credit' => $amount],
        ], ['purpose' => 'invoice', 'narration' => 'Export invoice']);
        $receipt = Receipt::query()->create([
            'number' => $this->doc(Receipt::class), 'status' => 'posted', 'party_id' => $m['buyer']->id,
            'commercial_invoice_id' => $invoice->id, 'amount' => $amount, 'currency_code' => 'BDT',
            'method' => 'tt', 'received_on' => now()->toDateString(), 'branch_id' => $b,
        ]);
        $journal = $this->posting->post($receipt, [
            ['account_id' => $this->accounts['1100'], 'debit' => $amount],
            ['account_id' => $this->accounts['1200'], 'credit' => $amount],
        ], ['purpose' => 'receipt', 'narration' => 'Export proceeds']);
        $receipt->update(['journal_id' => $journal->id]);
        GatePass::query()->create([
            'number' => $this->doc(GatePass::class), 'status' => 'exited', 'direction' => 'out',
            'party_id' => $m['buyer']->id, 'vehicle_no' => 'DHA-11-1234', 'driver' => 'Jalal',
            'purpose' => 'Finished fabric', 'reference_type' => CommercialInvoice::class, 'reference_id' => $invoice->id,
            'qr_token' => 'GP-'.$invoice->id, 'branch_id' => $b,
        ]);
        $this->costing->orderCost($c['order'], $m['article'], (string) $p['rollMetres'], '80');
        $this->payroll->pieceRun($m['operator'], now()->format('Y-m'));

        return compact('invoice', 'receipt');
    }

    private function yearLabel(): string
    {
        $start = now()->month >= 7 ? now()->year : now()->year - 1;

        return $start.'-'.substr((string) ($start + 1), -2);
    }

    private function doc(string $class): string
    {
        return $this->numbers->next($class, $this->branch->id);
    }

    /** @return array<string, array{0: string, 1: string, 2: bool}> */
    private function roleCatalog(): array
    {
        return [
            'owner' => ['Owner', 'admin', false],
            'managing-director' => ['Managing Director', 'admin', false],
            'factory-manager' => ['Factory Manager', 'admin', false],
            'weaving-manager' => ['Weaving Manager', 'admin', false],
            'preparatory-incharge' => ['Preparatory In-charge', 'admin', false],
            'loom-supervisor' => ['Loom Supervisor', 'floor', false],
            'loom-operator' => ['Loom Operator', 'floor', false],
            'quality-manager' => ['Quality Manager', 'admin', false],
            'inspector' => ['Inspector', 'admin', false],
            'finishing-manager' => ['Finishing Manager', 'admin', false],
            'merchandiser' => ['Merchandiser', 'admin', false],
            'commercial-manager' => ['Commercial Manager', 'admin', true],
            'purchase-manager' => ['Purchase Manager', 'admin', false],
            'store-incharge' => ['Store In-charge', 'admin', false],
            'maintenance-engineer' => ['Maintenance Engineer', 'admin', false],
            'utility-engineer' => ['Utility Engineer', 'admin', false],
            'hr-manager' => ['HR Manager', 'admin', false],
            'accountant' => ['Accountant', 'admin', true],
            'accounts-manager' => ['Accounts Manager', 'admin', true],
            'auditor' => ['Auditor', 'admin', true],
            'it-admin' => ['IT Admin', 'admin', false],
            'compliance-officer' => ['Compliance Officer', 'admin', false],
            'ppc-manager' => ['PPC Manager', 'admin', false],
            'buyer' => ['Buyer', 'buyer', false],
            'supplier' => ['Supplier', 'supplier', false],
        ];
    }
}
