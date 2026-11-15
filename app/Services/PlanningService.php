<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\FabricArticle;
use App\Models\FabricRoll;
use App\Models\SalesOrder;
use App\Models\SalesOrderLine;
use App\Models\StockLot;
use App\Models\YarnRequirement;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

class PlanningService
{
    public function __construct(private readonly WeavingMath $math) {}

    /**
     * @return array{earliest: string, shortages: array<int, string>, credit_ok: bool, margin_ok: bool, feasible: bool}
     */
    public function feasibility(SalesOrder $order): array
    {
        $shortages = [];
        $metresPerDay = 0.0;
        foreach (SalesOrderLine::query()->where('sales_order_id', $order->id)->get() as $line) {
            $article = $line->article;
            if (! $article) {
                $shortages[] = 'Line has no article';
                continue;
            }
            $sheet = $this->math->technicalSheet($article);
            $hundreds = BigDecimal::of((string) $line->quantity)->dividedBy('100', 4, RoundingMode::HALF_UP);
            $warp = BigDecimal::of($sheet['warp_kg_per_100m'])->multipliedBy($hundreds);
            $stock = StockLot::query()->where('item_type', 'yarn')->where('item_id', $article->warp_yarn_id)->where('status', 'released')->sum('qty');
            if (BigDecimal::of((string) $stock)->isLessThan($warp)) {
                $shortages[] = 'Warp yarn short by '.$warp->minus((string) $stock)->toScale(3, RoundingMode::HALF_UP).' kg';
            }
            $metresPerDay += (float) $sheet['metres_per_loom_shift'] * 3;
        }

        $buyer = $order->buyer;
        $open = (float) \App\Models\CommercialInvoice::query()->where('buyer_id', $order->buyer_id)->whereNotIn('status', ['paid', 'cancelled'])->sum('total');
        $creditOk = ! $buyer || (float) $buyer->credit_limit <= 0 || ($open + (float) $order->total) <= (float) $buyer->credit_limit;
        if (! $creditOk) {
            $shortages[] = 'Credit limit exceeded';
        }
        $marginOk = (float) $order->margin_pct >= (float) config('mill.behind_plan_pct', 10) || (float) $order->margin_pct === 0.0;
        $days = $metresPerDay > 0 ? (int) ceil(((float) SalesOrderLine::query()->where('sales_order_id', $order->id)->sum('quantity')) / $metresPerDay) : 30;
        $earliest = now()->addDays(max($days, 1))->toDateString();

        return [
            'earliest' => $earliest,
            'shortages' => $shortages,
            'credit_ok' => $creditOk,
            'margin_ok' => $marginOk,
            'feasible' => $shortages === [],
        ];
    }

    public function yarnRequirement(int $planId, FabricArticle $article, string $metres): YarnRequirement
    {
        $sheet = $this->math->technicalSheet($article);
        $hundreds = BigDecimal::of($metres)->dividedBy('100', 4, RoundingMode::HALF_UP);
        $required = BigDecimal::of($sheet['warp_kg_per_100m'])->multipliedBy($hundreds)->toScale(3, RoundingMode::HALF_UP);
        $available = BigDecimal::of((string) StockLot::query()->where('item_type', 'yarn')->where('item_id', $article->warp_yarn_id)->where('status', 'released')->sum('qty'));
        $shortage = $required->isGreaterThan($available) ? $required->minus($available) : BigDecimal::zero();

        return YarnRequirement::query()->create([
            'production_plan_id' => $planId,
            'yarn_id' => $article->warp_yarn_id,
            'direction' => 'warp',
            'required_kg' => (string) $required,
            'available_kg' => (string) $available->toScale(3, RoundingMode::HALF_UP),
            'shortage_kg' => (string) $shortage->toScale(3, RoundingMode::HALF_UP),
            'branch_id' => $article->branch_id,
        ]);
    }
}
