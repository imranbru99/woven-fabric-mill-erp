<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CommercialInvoice;
use App\Models\FabricRoll;
use App\Models\Issue;
use App\Models\JournalLine;
use App\Models\LoomProduction;
use App\Models\LoomStoppage;
use App\Models\OrderCost;
use App\Models\StockLot;
use Illuminate\Support\Facades\Schema;

class ReportCatalog
{
    /** @return array<int, string> */
    public function names(): array
    {
        $names = [];
        foreach (['production_metres', 'avg_efficiency', 'roll_count', 'open_issues', 'invoice_total', 'yarn_stock_kg', 'stoppage_minutes', 'defect_points'] as $metric) {
            foreach (['all', 'today', 'month', 'by_loom', 'by_article', 'by_shift', 'by_buyer', 'by_grade', 'by_status', 'by_warehouse', 'by_supplier', 'by_department'] as $dimension) {
                $names[] = $metric.'.'.$dimension;
            }
        }

        return [...$names, 'trial_balance', 'profit_and_loss', 'order_profitability', 'stock_to_gl', 'production_to_sales'];
    }

    /** @return array{name: string, total: string, rows: array<int, array<string, mixed>>} */
    public function run(string $name): array
    {
        if (! in_array($name, $this->names(), true)) {
            return ['name' => $name, 'total' => '0', 'rows' => []];
        }

        [$metric, $dimension] = array_pad(explode('.', $name, 2), 2, null);

        $rows = match ($metric) {
            'production_metres' => $this->grouped(LoomProduction::query(), 'metres', $dimension, 'production_date'),
            'avg_efficiency' => $this->grouped(LoomProduction::query(), 'efficiency', $dimension, 'production_date', true),
            'roll_count' => $this->grouped(FabricRoll::query(), 'id', $dimension, 'doffed_at', false, true),
            'open_issues' => $this->grouped(Issue::query()->whereNotIn('status', ['closed']), 'id', $dimension, 'created_at', false, true),
            'invoice_total' => $this->grouped(CommercialInvoice::query(), 'total', $dimension, 'invoice_date'),
            'yarn_stock_kg' => $this->grouped(StockLot::query()->where('item_type', 'yarn')->where('status', 'released'), 'qty', $dimension, 'created_at'),
            'stoppage_minutes' => $this->grouped(LoomStoppage::query(), 'minutes', $dimension, 'started_at'),
            'defect_points' => $this->grouped(FabricRoll::query(), 'points', $dimension, 'doffed_at'),
            default => $this->named($name),
        };

        $total = '0';
        foreach ($rows as $row) {
            $total = bcadd($total, (string) ($row['value'] ?? 0), 3);
        }

        return ['name' => $name, 'total' => $total, 'rows' => $rows];
    }

    /** @return array<int, array<string, mixed>> */
    private function grouped($query, string $column, ?string $dimension, string $dateColumn, bool $average = false, bool $count = false): array
    {
        if ($dimension === 'today') {
            $query->whereDate($dateColumn, now()->toDateString());
        } elseif ($dimension === 'month') {
            $query->whereBetween($dateColumn, [now()->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()]);
        }

        $group = match ($dimension) {
            'by_loom' => 'loom_id',
            'by_article' => 'article_id',
            'by_shift' => 'shift_id',
            'by_buyer' => 'buyer_id',
            'by_grade' => 'grade',
            'by_status' => 'status',
            'by_warehouse' => 'warehouse_id',
            'by_supplier' => 'supplier_id',
            'by_department' => 'department_id',
            default => null,
        };

        if ($group && ! $this->hasColumn($query->getModel()->getTable(), $group)) {
            $group = null;
        }

        if ($group) {
            $select = $count ? "count({$column}) as value" : ($average ? "avg({$column}) as value" : "sum({$column}) as value");

            return $query->selectRaw($group.' as bucket, '.$select)
                ->groupBy($group)
                ->get()
                ->map(fn ($row) => ['bucket' => (string) $row->bucket, 'value' => (string) $row->value])
                ->all();
        }

        $value = $count ? $query->count() : ($average ? $query->avg($column) : $query->sum($column));

        return [['bucket' => $dimension ?? 'all', 'value' => (string) ($value ?? 0)]];
    }

    /** @return array<int, array<string, mixed>> */
    private function named(string $name): array
    {
        return match ($name) {
            'trial_balance' => JournalLine::query()
                ->selectRaw('account_id as bucket, sum(debit) - sum(credit) as value')
                ->groupBy('account_id')
                ->get()
                ->map(fn ($row) => ['bucket' => (string) $row->bucket, 'value' => (string) $row->value])
                ->all(),
            'profit_and_loss' => JournalLine::query()
                ->whereHas('account', fn ($q) => $q->whereIn('account_type', ['income', 'expense']))
                ->selectRaw('account_id as bucket, sum(credit) - sum(debit) as value')
                ->groupBy('account_id')
                ->get()
                ->map(fn ($row) => ['bucket' => (string) $row->bucket, 'value' => (string) $row->value])
                ->all(),
            'order_profitability' => OrderCost::query()
                ->get()
                ->map(fn ($row) => ['bucket' => (string) $row->sales_order_id, 'value' => (string) $row->profit])
                ->all(),
            'stock_to_gl', 'production_to_sales' => app(ReconciliationService::class)->snapshot()['accounts']
                ? collect(app(ReconciliationService::class)->snapshot()['accounts'])->map(fn ($value, $code) => ['bucket' => (string) $code, 'value' => (string) $value])->values()->all()
                : [],
            default => [],
        };
    }

    private function hasColumn(string $table, string $column): bool
    {
        return in_array($column, ['loom_id', 'article_id', 'shift_id', 'buyer_id', 'grade', 'status', 'warehouse_id', 'supplier_id', 'department_id'], true)
            && Schema::hasColumn($table, $column);
    }
}
