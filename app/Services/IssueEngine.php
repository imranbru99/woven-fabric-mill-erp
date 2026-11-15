<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Attendance;
use App\Models\BankAccount;
use App\Models\BankReconciliation;
use App\Models\BuyerClaim;
use App\Models\Chemical;
use App\Models\CommercialInvoice;
use App\Models\ComplianceDocument;
use App\Models\DocumentCheck;
use App\Models\EtpLog;
use App\Models\GoodsReceipt;
use App\Models\Issue;
use App\Models\IssueRule;
use App\Models\LabTest;
use App\Models\LetterOfCredit;
use App\Models\LoomProduction;
use App\Models\LoomSetup;
use App\Models\LoomStoppage;
use App\Models\OrderCost;
use App\Models\Party;
use App\Models\PmSchedule;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use App\Models\SalesOrderLine;
use App\Models\SizingBatch;
use App\Models\Spare;
use App\Models\StockCountLine;
use App\Models\StockLot;
use App\Models\User;
use App\Models\UtilityReading;
use App\Models\WeaverBeam;
use App\Models\WorkOrder;
use App\Models\Yarn;
use App\Models\YarnRequirement;
use Illuminate\Support\Facades\DB;

class IssueEngine
{
    /** @return array<int, string> */
    public static function codes(): array
    {
        return array_keys(self::definitions());
    }

    public function seedRules(): void
    {
        foreach (self::definitions() as $code => $meta) {
            IssueRule::query()->updateOrCreate(['code' => $code], [
                'name' => $meta['name'],
                'module' => $meta['module'],
                'severity' => $meta['severity'],
                'enabled' => true,
                'threshold' => $meta['threshold'],
                'assign_role' => $meta['role'],
                'description' => $meta['name'],
            ]);
        }
    }

    /** @return array<int, Issue> */
    public function evaluate(?string $only = null): array
    {
        $this->seedRules();
        $opened = [];
        foreach (self::definitions() as $code => $meta) {
            if ($only && $only !== $code) {
                continue;
            }
            $rule = IssueRule::query()->where('code', $code)->where('enabled', true)->first();
            if (! $rule) {
                continue;
            }
            foreach ($meta['detect']() as $hit) {
                $opened[] = $this->open($rule, $hit);
            }
        }

        return array_values(array_filter($opened));
    }

    /**
     * @param  array{title: string, related_type?: string, related_id?: int, type?: string, severity?: string}  $hit
     */
    public function open(IssueRule $rule, array $hit): ?Issue
    {
        $existing = Issue::query()
            ->where('rule_code', $rule->code)
            ->where('related_type', $hit['related_type'] ?? null)
            ->where('related_id', $hit['related_id'] ?? null)
            ->whereNotIn('status', ['closed'])
            ->first();
        if ($existing) {
            return $existing;
        }

        $hours = ['critical' => 4, 'high' => 24, 'medium' => 72, 'low' => 168][$hit['severity'] ?? $rule->severity] ?? 72;
        $assignee = User::query()->whereHas('roles', fn ($q) => $q->where('slug', $rule->assign_role))->first();

        return Issue::query()->create([
            'number' => app(NumberSeriesService::class)->next(Issue::class),
            'issue_type' => $hit['type'] ?? $rule->module,
            'severity' => $hit['severity'] ?? $rule->severity,
            'source' => 'auto-rule',
            'rule_code' => $rule->code,
            'related_type' => $hit['related_type'] ?? null,
            'related_id' => $hit['related_id'] ?? null,
            'assigned_to' => $assignee?->id,
            'status' => 'open',
            'sla_due_at' => now()->addHours($hours),
            'root_cause' => $hit['title'],
            'branch_id' => $hit['branch_id'] ?? null,
        ]);
    }

    /** @return array<string, array<string, mixed>> */
    public static function definitions(): array
    {
        $hit = fn (string $title, ?string $type = null, ?int $id = null, ?int $branch = null): array => [
            'title' => $title,
            'related_type' => $type,
            'related_id' => $id,
            'branch_id' => $branch,
        ];

        return [
            'order_delivery_at_risk' => self::meta('Order delivery at risk', 'production', 'high', 'ppc-manager', ['behind_pct' => 10], function () use ($hit) {
                $out = [];
                foreach (SalesOrder::query()->whereIn('status', ['approved', 'in_production'])->whereDate('delivery_date', '<', now()->toDateString())->get() as $order) {
                    $lines = SalesOrderLine::query()->where('sales_order_id', $order->id)->get();
                    $qty = (float) $lines->sum('quantity');
                    $done = (float) $lines->sum('produced_qty');
                    if ($qty > 0 && ($done / $qty) < 0.9) {
                        $out[] = $hit('Order '.$order->number.' is behind plan', SalesOrder::class, $order->id, $order->branch_id);
                    }
                }

                return $out;
            }),
            'yarn_shortage_7_days' => self::meta('Yarn shortage next 7 days', 'stores', 'high', 'purchase-manager', ['days' => 7], function () use ($hit) {
                return YarnRequirement::query()->where('shortage_kg', '>', 0)->get()->map(fn ($row) => $hit('Yarn short '.$row->shortage_kg.' kg', YarnRequirement::class, $row->id, $row->branch_id))->all();
            }),
            'loom_efficiency_below_target' => self::meta('Loom efficiency below target', 'production', 'medium', 'loom-supervisor', ['shifts' => 3, 'target' => 85], function () use ($hit) {
                $out = [];
                $groups = LoomProduction::query()->orderBy('production_date')->get()->groupBy('loom_id');
                foreach ($groups as $loomId => $rows) {
                    $last = $rows->take(-3);
                    if ($last->count() >= 3 && $last->every(fn ($row) => (float) $row->efficiency < 85)) {
                        $out[] = $hit('Loom efficiency under target for 3 shifts', 'loom', (int) $loomId, $last->last()->branch_id);
                    }
                }

                return $out;
            }),
            'warp_breaks_high' => self::meta('Warp breaks above threshold', 'production', 'high', 'preparatory-incharge', ['per_hour' => 2], function () use ($hit) {
                return LoomProduction::query()->where('warp_breaks', '>', 8)->get()->map(fn ($row) => $hit('Warp breaks high on production '.$row->id, LoomProduction::class, $row->id, $row->branch_id))->all();
            }),
            'loom_stopped_30_min' => self::meta('Loom stopped 30 minutes', 'production', 'medium', 'loom-supervisor', ['minutes' => 30], function () use ($hit) {
                return LoomStoppage::query()->where('reason_code', 'unspecified')->where('minutes', '>=', 30)->where('minutes', '<', 120)->get()->map(fn ($row) => $hit('Stoppage without reason', LoomStoppage::class, $row->id, $row->branch_id))->all();
            }),
            'loom_stopped_2_hours' => self::meta('Loom stopped 2 hours', 'production', 'critical', 'weaving-manager', ['minutes' => 120], function () use ($hit) {
                return LoomStoppage::query()->where('minutes', '>=', 120)->get()->map(fn ($row) => $hit('Long stoppage', LoomStoppage::class, $row->id, $row->branch_id))->all();
            }),
            'beam_running_out' => self::meta('Beam about to run out', 'production', 'high', 'preparatory-incharge', ['metres' => 80], function () use ($hit) {
                return WeaverBeam::query()->where('position', 'on_loom')->where('leftover_m', '<', 80)->where('leftover_m', '>', 0)->get()->map(fn ($row) => $hit('Beam '.$row->number.' running out', WeaverBeam::class, $row->id, $row->branch_id))->all();
            }),
            'style_change_repeat' => self::meta('Repeated style change', 'production', 'medium', 'weaving-manager', ['count' => 2], function () use ($hit) {
                $out = [];
                $rows = LoomSetup::query()->where('setup_minutes', '>', 45)->get()->groupBy(fn ($row) => $row->loom_id.'-'.$row->article_id);
                foreach ($rows as $group) {
                    if ($group->count() >= 2) {
                        $out[] = $hit('Style change repeating', LoomSetup::class, $group->first()->id, $group->first()->branch_id);
                    }
                }

                return $out;
            }),
            'leftover_warp_pileup' => self::meta('Left-over warp pile-up', 'production', 'low', 'ppc-manager', ['metres' => 500], function () use ($hit) {
                $sum = (float) WeaverBeam::query()->where('position', 'store')->sum('leftover_m');

                return $sum > 500 ? [$hit('Left-over warp '.$sum.' m in store')] : [];
            }),
            'roll_grade_poor' => self::meta('Poor roll grade', 'quality', 'high', 'quality-manager', ['count' => 1], function () use ($hit) {
                return DB::table('fabric_rolls')->whereIn('grade', ['B', 'C', 'reject'])->get()->map(fn ($row) => $hit('Roll '.$row->number.' graded '.$row->grade, 'roll', (int) $row->id, $row->branch_id))->all();
            }),
            'size_pickup_out_of_tolerance' => self::meta('Size pick-up out of tolerance', 'quality', 'high', 'preparatory-incharge', ['points' => 1.5], function () use ($hit) {
                return SizingBatch::query()->get()->filter(fn ($row) => abs((float) $row->pickup_actual - (float) $row->pickup_target) > 1.5)->map(fn ($row) => $hit('Size pick-up off target', SizingBatch::class, $row->id, $row->branch_id))->all();
            }),
            'yarn_test_failure' => self::meta('Yarn lot test failure', 'quality', 'critical', 'quality-manager', [], function () use ($hit) {
                return LabTest::query()->where('sample_type', 'yarn')->where('result', 'fail')->get()->map(fn ($row) => $hit('Yarn test failed', LabTest::class, $row->id, $row->branch_id))->all();
            }),
            'buyer_claim' => self::meta('Buyer claim received', 'quality', 'high', 'quality-manager', [], function () use ($hit) {
                return BuyerClaim::query()->whereIn('status', ['draft', 'open', 'submitted'])->get()->map(fn ($row) => $hit('Buyer claim '.$row->number, BuyerClaim::class, $row->id, $row->branch_id))->all();
            }),
            'shade_shrinkage_out' => self::meta('Shade or shrinkage out of tolerance', 'quality', 'high', 'finishing-manager', [], function () use ($hit) {
                return DB::table('finishing_batches')->where('is_reprocess', 1)->get()->map(fn ($row) => $hit('Reprocess batch '.$row->number, 'finishing', (int) $row->id, $row->branch_id))->all();
            }),
            'reorder_level' => self::meta('Reorder level hit', 'stores', 'medium', 'purchase-manager', [], function () use ($hit) {
                $out = [];
                foreach (Yarn::query()->where('reorder_kg', '>', 0)->get() as $yarn) {
                    $stock = (float) StockLot::query()->where('item_type', 'yarn')->where('item_id', $yarn->id)->where('status', 'released')->sum('qty');
                    if ($stock < (float) $yarn->reorder_kg) {
                        $out[] = $hit('Reorder '.$yarn->code, Yarn::class, $yarn->id, $yarn->branch_id);
                    }
                }

                return $out;
            }),
            'chemical_expiry' => self::meta('Chemical near expiry', 'stores', 'medium', 'store-incharge', ['days' => 30], function () use ($hit) {
                return StockLot::query()->where('item_type', 'chemical')->whereDate('expiry_date', '<=', now()->addDays(30))->get()->map(fn ($row) => $hit('Chemical lot '.$row->lot_no.' expiring', StockLot::class, $row->id, $row->branch_id))->all();
            }),
            'grn_qc_overdue' => self::meta('GRN pending QC', 'stores', 'medium', 'quality-manager', ['hours' => 48], function () use ($hit) {
                return GoodsReceipt::query()->where('qc_status', 'quarantine')->where('created_at', '<', now()->subHours(48))->get()->map(fn ($row) => $hit('GRN QC overdue '.$row->number, GoodsReceipt::class, $row->id, $row->branch_id))->all();
            }),
            'stock_count_variance' => self::meta('Stock count variance', 'stores', 'high', 'store-incharge', ['qty' => 1], function () use ($hit) {
                return StockCountLine::query()->whereRaw('abs(variance_qty) > 1')->get()->map(fn ($row) => $hit('Count variance', StockCountLine::class, $row->id, $row->branch_id))->all();
            }),
            'po_delivery_overdue' => self::meta('PO delivery overdue', 'stores', 'medium', 'purchase-manager', [], function () use ($hit) {
                return PurchaseOrder::query()->whereDate('delivery_date', '<', now())->whereNotIn('status', ['closed', 'received', 'cancelled'])->get()->map(fn ($row) => $hit('PO overdue '.$row->number, PurchaseOrder::class, $row->id, $row->branch_id))->all();
            }),
            'pm_overdue' => self::meta('PM overdue', 'maintenance', 'medium', 'maintenance-engineer', [], function () use ($hit) {
                return PmSchedule::query()->where('is_active', true)->whereDate('next_due', '<', now())->get()->map(fn ($row) => $hit('PM overdue', PmSchedule::class, $row->id, $row->branch_id))->all();
            }),
            'repeated_breakdown' => self::meta('Repeated breakdown', 'maintenance', 'high', 'maintenance-engineer', ['count' => 3], function () use ($hit) {
                $out = [];
                $rows = WorkOrder::query()->where('work_type', 'breakdown')->where('created_at', '>=', now()->subDays(30))->get()->groupBy('machine_id');
                foreach ($rows as $machineId => $group) {
                    if ($machineId && $group->count() >= 3) {
                        $out[] = $hit('Machine broke down 3 times', 'machine', (int) $machineId, $group->first()->branch_id);
                    }
                }

                return $out;
            }),
            'critical_spare_out' => self::meta('Critical spare out of stock', 'maintenance', 'critical', 'maintenance-engineer', [], function () use ($hit) {
                $out = [];
                foreach (Spare::query()->where('criticality', 'A')->get() as $spare) {
                    $qty = (float) StockLot::query()->where('item_type', 'spare')->where('item_id', $spare->id)->sum('qty');
                    if ($qty <= 0) {
                        $out[] = $hit('Critical spare '.$spare->code.' is out', Spare::class, $spare->id, $spare->branch_id);
                    }
                }

                return $out;
            }),
            'energy_per_metre_rise' => self::meta('Energy per metre rise', 'maintenance', 'medium', 'utility-engineer', ['pct' => 15], function () use ($hit) {
                return UtilityReading::query()->where('utility', 'power')->where('cost_per_metre', '>', 2)->get()->map(fn ($row) => $hit('kWh per metre high', UtilityReading::class, $row->id, $row->branch_id))->all();
            }),
            'compressor_pressure_low' => self::meta('Compressor pressure low', 'maintenance', 'high', 'utility-engineer', ['bar' => 5], function () use ($hit) {
                return UtilityReading::query()->where('utility', 'air')->where('reading_value', '<', 5)->get()->map(fn ($row) => $hit('Air pressure low', UtilityReading::class, $row->id, $row->branch_id))->all();
            }),
            'boiler_etp_breach' => self::meta('Boiler or ETP breach', 'maintenance', 'critical', 'utility-engineer', [], function () use ($hit) {
                return EtpLog::query()->where('within_limit', false)->get()->map(fn ($row) => $hit('ETP parameter breach', EtpLog::class, $row->id, $row->branch_id))->all();
            }),
            'lc_expiry_near' => self::meta('LC expiry near', 'finance', 'high', 'commercial-manager', ['days' => 15], function () use ($hit) {
                return LetterOfCredit::query()->whereDate('expiry_date', '<=', now()->addDays(15))->whereDate('expiry_date', '>=', now())->get()->map(fn ($row) => $hit('LC '.$row->number.' nearing expiry', LetterOfCredit::class, $row->id, $row->branch_id))->all();
            }),
            'btb_utilisation_high' => self::meta('BTB utilisation high', 'finance', 'high', 'commercial-manager', ['pct' => 90], function () use ($hit) {
                return LetterOfCredit::query()->where('lc_type', 'btb')->get()->filter(function ($row) {
                    return (float) $row->amount > 0 && ((float) $row->utilised / (float) $row->amount) >= 0.9;
                })->map(fn ($row) => $hit('BTB limit above 90%', LetterOfCredit::class, $row->id, $row->branch_id))->all();
            }),
            'cost_variance' => self::meta('Unusual order cost variance', 'finance', 'medium', 'accounts-manager', ['pct' => 15], function () use ($hit) {
                return OrderCost::query()->get()->filter(function ($row) {
                    return (float) $row->revenue > 0 && ((float) $row->profit / (float) $row->revenue) < 0;
                })->map(fn ($row) => $hit('Order lost money', OrderCost::class, $row->id, $row->branch_id))->all();
            }),
            'export_doc_discrepancy' => self::meta('Export document discrepancy', 'finance', 'high', 'commercial-manager', [], function () use ($hit) {
                return DocumentCheck::query()->where('matches_lc', false)->where('is_present', true)->get()->map(fn ($row) => $hit('LC document mismatch: '.$row->document_name, DocumentCheck::class, $row->id, $row->branch_id))->all();
            }),
            'buyer_over_credit' => self::meta('Buyer over credit limit', 'finance', 'high', 'accounts-manager', [], function () use ($hit) {
                $out = [];
                foreach (Party::query()->where('type', 'buyer')->where('credit_limit', '>', 0)->get() as $buyer) {
                    $due = (float) CommercialInvoice::query()->where('buyer_id', $buyer->id)->whereNotIn('status', ['paid', 'cancelled'])->sum('total');
                    if ($due > (float) $buyer->credit_limit) {
                        $out[] = $hit('Buyer '.$buyer->name.' over credit', Party::class, $buyer->id, $buyer->branch_id);
                    }
                }

                return $out;
            }),
            'bank_recon_overdue' => self::meta('Bank reconciliation overdue', 'finance', 'medium', 'accountant', ['day' => 5], function () use ($hit) {
                if (BankAccount::query()->doesntExist()) {
                    return [];
                }
                $done = BankReconciliation::query()->whereDate('statement_date', '>=', now()->startOfMonth()->toDateString())->exists();

                return $done ? [] : [$hit('Bank reconciliation not done this month')];
            }),
            'overtime_legal_limit' => self::meta('Overtime above legal limit', 'hr', 'high', 'hr-manager', ['minutes' => 600], function () use ($hit) {
                $out = [];
                $groups = Attendance::query()->where('work_date', '>=', now()->startOfWeek())->get()->groupBy('employee_id');
                foreach ($groups as $employeeId => $rows) {
                    if ((int) $rows->sum('ot_minutes') > 600) {
                        $out[] = $hit('Weekly overtime above limit', 'employee', (int) $employeeId, $rows->first()->branch_id);
                    }
                }

                return $out;
            }),
            'attendance_device_offline' => self::meta('Attendance device offline', 'hr', 'medium', 'it-admin', ['minutes' => 60], function () use ($hit) {
                if (! DB::getSchemaBuilder()->hasTable('attendance_devices')) {
                    return [];
                }

                return DB::table('attendance_devices')->where('status', 'offline')->where(function ($q): void {
                    $q->whereNull('last_seen_at')->orWhere('last_seen_at', '<', now()->subHour());
                })->get()->map(fn ($row) => $hit('Device '.$row->name.' offline', 'attendance_device', (int) $row->id))->all();
            }),
            'certificate_expiry' => self::meta('Certificate expiring', 'hr', 'medium', 'compliance-officer', ['days' => 30], function () use ($hit) {
                return ComplianceDocument::query()->whereDate('expires_on', '<=', now()->addDays(30))->whereDate('expires_on', '>=', now())->get()->map(fn ($row) => $hit($row->name.' expires soon', ComplianceDocument::class, $row->id, $row->branch_id))->all();
            }),
            'absenteeism_spike' => self::meta('Absenteeism spike', 'hr', 'medium', 'hr-manager', ['count' => 3], function () use ($hit) {
                $count = Attendance::query()->whereDate('work_date', now()->toDateString())->where('status', 'absent')->count();

                return $count >= 3 ? [$hit($count.' absentees today')] : [];
            }),
        ];
    }

    private static function meta(string $name, string $module, string $severity, string $role, array $threshold, \Closure $detect): array
    {
        return compact('name', 'module', 'severity', 'role', 'threshold') + ['detect' => $detect];
    }
}
