<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\LandedCost;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

class LandedCostService
{
    /** @param  array{invoice?: numeric-string|int|float, freight?: numeric-string|int|float, insurance?: numeric-string|int|float, duty?: numeric-string|int|float, port?: numeric-string|int|float, cf?: numeric-string|int|float, qty?: numeric-string|int|float}  $parts */
    public function calculate(array $parts): array
    {
        $invoice = BigDecimal::of((string) ($parts['invoice'] ?? 0));
        $freight = BigDecimal::of((string) ($parts['freight'] ?? 0));
        $insurance = BigDecimal::of((string) ($parts['insurance'] ?? 0));
        $duty = BigDecimal::of((string) ($parts['duty'] ?? 0));
        $port = BigDecimal::of((string) ($parts['port'] ?? 0));
        $cf = BigDecimal::of((string) ($parts['cf'] ?? 0));
        $total = $invoice->plus($freight)->plus($insurance)->plus($duty)->plus($port)->plus($cf);
        $qty = BigDecimal::of((string) ($parts['qty'] ?? 1));
        if ($qty->isZero()) {
            $qty = BigDecimal::one();
        }

        return [
            'total' => (string) $total->toScale(2, RoundingMode::HALF_UP),
            'unit_cost' => (string) $total->dividedBy($qty, 4, RoundingMode::HALF_UP),
        ];
    }

    public function store(int $purchaseOrderId, ?int $yarnLotId, array $parts, ?int $branchId = null): LandedCost
    {
        $calc = $this->calculate($parts);

        return LandedCost::query()->create([
            'purchase_order_id' => $purchaseOrderId,
            'yarn_lot_id' => $yarnLotId,
            'invoice_amount' => $parts['invoice'] ?? 0,
            'freight' => $parts['freight'] ?? 0,
            'insurance' => $parts['insurance'] ?? 0,
            'duty' => $parts['duty'] ?? 0,
            'port_charges' => $parts['port'] ?? 0,
            'cf_charges' => $parts['cf'] ?? 0,
            'quantity' => $parts['qty'] ?? 0,
            'unit_cost' => $calc['unit_cost'],
            'branch_id' => $branchId,
        ]);
    }
}
