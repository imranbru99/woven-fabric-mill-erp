<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CostSheet;
use App\Models\FabricArticle;
use App\Models\OrderCost;
use App\Models\SalesOrder;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

class CostingService
{
    public function __construct(private readonly WeavingMath $math) {}

    public function costSheet(FabricArticle $article, string $yarnRatePerKg, string $marginPct = '12'): CostSheet
    {
        $sheet = $this->math->technicalSheet($article);
        $yarn = BigDecimal::of($sheet['warp_kg_per_100m'])->plus($sheet['weft_kg_per_100m'])->dividedBy('100', 4, RoundingMode::HALF_UP);
        $yarnCost = $yarn->multipliedBy($yarnRatePerKg);
        $sizing = BigDecimal::of('1.2000');
        $weaving = BigDecimal::of('8.5000');
        $process = BigDecimal::of('6.0000');
        $overhead = BigDecimal::of('2.2500');
        $finance = BigDecimal::of('0.8000');
        $commission = BigDecimal::of('1.0000');
        $cost = $yarnCost->plus($sizing)->plus($weaving)->plus($process)->plus($overhead)->plus($finance)->plus($commission);
        $quoted = $cost->dividedBy(BigDecimal::one()->minus(BigDecimal::of($marginPct)->dividedBy('100', 6, RoundingMode::HALF_UP)), 4, RoundingMode::HALF_UP);

        return CostSheet::query()->create([
            'number' => app(NumberSeriesService::class)->next(CostSheet::class, $article->branch_id),
            'status' => 'approved',
            'article_id' => $article->id,
            'currency_code' => 'BDT',
            'yarn_cost_per_m' => (string) $yarnCost->toScale(4, RoundingMode::HALF_UP),
            'sizing_cost_per_m' => (string) $sizing,
            'weaving_cost_per_m' => (string) $weaving,
            'process_cost_per_m' => (string) $process,
            'overhead_per_m' => (string) $overhead,
            'finance_cost_per_m' => (string) $finance,
            'commission_per_m' => (string) $commission,
            'target_margin_pct' => $marginPct,
            'quoted_rate' => (string) $quoted,
            'valid_until' => now()->addDays(30)->toDateString(),
            'sensitivity' => ['yarn_plus_10' => (string) $yarnCost->multipliedBy('1.1')->toScale(4, RoundingMode::HALF_UP)],
            'branch_id' => $article->branch_id,
        ]);
    }

    public function orderCost(SalesOrder $order, FabricArticle $article, string $metres, string $rate): OrderCost
    {
        $sheet = $this->math->technicalSheet($article);
        $m = BigDecimal::of($metres);
        $yarnKg = BigDecimal::of($sheet['warp_kg_per_100m'])->plus($sheet['weft_kg_per_100m'])->multipliedBy($m)->dividedBy('100', 4, RoundingMode::HALF_UP);
        $yarn = $yarnKg->multipliedBy('220');
        $sizing = $m->multipliedBy('1.2');
        $weaving = $m->multipliedBy('8.5');
        $finishing = $m->multipliedBy('6');
        $packing = $m->multipliedBy('0.4');
        $wastage = $yarn->multipliedBy('0.03');
        $overhead = $m->multipliedBy('2.25');
        $total = $yarn->plus($sizing)->plus($weaving)->plus($finishing)->plus($packing)->plus($wastage)->plus($overhead);
        $revenue = $m->multipliedBy($rate);
        $profit = $revenue->minus($total);

        return OrderCost::query()->create([
            'sales_order_id' => $order->id,
            'article_id' => $article->id,
            'metres' => (string) $m->toScale(3, RoundingMode::HALF_UP),
            'yarn' => $this->money($yarn),
            'sizing' => $this->money($sizing),
            'weaving' => $this->money($weaving),
            'finishing' => $this->money($finishing),
            'packing' => $this->money($packing),
            'wastage' => $this->money($wastage),
            'overhead' => $this->money($overhead),
            'total' => $this->money($total),
            'cost_per_metre' => (string) $total->dividedBy($m, 4, RoundingMode::HALF_UP),
            'revenue' => $this->money($revenue),
            'profit' => $this->money($profit),
            'branch_id' => $order->branch_id,
        ]);
    }

    private function money(BigDecimal $value): string
    {
        return (string) $value->toScale(2, RoundingMode::HALF_UP);
    }
}
