<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\StockBalance;
use App\Models\StockLot;
use App\Models\StockMove;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class StockService
{
    public function receive(array $data): StockLot
    {
        return DB::transaction(function () use ($data): StockLot {
            $qty = $this->scale((string) $data['qty']);
            $cost = BigDecimal::of((string) ($data['unit_cost'] ?? 0))->toScale(4, RoundingMode::HALF_UP);
            $lot = StockLot::query()->create([
                'item_type' => $data['item_type'],
                'item_id' => $data['item_id'],
                'lot_no' => $data['lot_no'],
                'warehouse_id' => $data['warehouse_id'] ?? null,
                'supplier_id' => $data['supplier_id'] ?? null,
                'yarn_lot_id' => $data['yarn_lot_id'] ?? null,
                'qty' => (string) $qty,
                'reserved_qty' => '0',
                'uom' => $data['uom'] ?? 'kg',
                'unit_cost' => (string) $cost,
                'status' => $data['status'] ?? 'released',
                'expiry_date' => $data['expiry_date'] ?? null,
                'branch_id' => $data['branch_id'] ?? null,
            ]);

            $this->writeMove($lot, (string) $qty, 'grn', $data);

            return $lot->refresh();
        });
    }

    public function issue(StockLot $lot, string $qty, array $context = []): StockMove
    {
        return DB::transaction(function () use ($lot, $qty, $context): StockMove {
            $lot = StockLot::query()->lockForUpdate()->findOrFail($lot->id);
            if ($lot->status !== 'released') {
                throw new RuntimeException('Lot '.$lot->lot_no.' is on '.$lot->status.' and cannot be issued.');
            }
            $this->guardLotMix($lot, $context);
            $quantity = $this->scale($qty);
            if (BigDecimal::of((string) $lot->qty)->isLessThan($quantity)) {
                throw new RuntimeException('Insufficient stock in lot '.$lot->lot_no.'.');
            }
            $lot->qty = (string) BigDecimal::of((string) $lot->qty)->minus($quantity)->toScale(3, RoundingMode::HALF_UP);
            $lot->save();

            return $this->writeMove($lot, (string) $quantity->negated(), $context['move_type'] ?? 'issue', $context);
        });
    }

    public function release(StockLot $lot): StockLot
    {
        $lot->status = 'released';
        $lot->hold_reason = null;
        $lot->save();

        return $lot;
    }

    public function guardLotMix(StockLot $lot, array $context): void
    {
        $jobCardId = $context['job_card_id'] ?? null;
        if (! $jobCardId || $lot->item_type !== 'yarn' || ! empty($context['mix_approved'])) {
            return;
        }

        $mixed = StockMove::query()
            ->where('job_card_id', $jobCardId)
            ->where('move_type', 'issue')
            ->whereHas('stockLot', function ($query) use ($lot): void {
                $query->where('item_type', 'yarn')
                    ->where('item_id', $lot->item_id)
                    ->where('id', '!=', $lot->id);
            })
            ->exists();

        if ($mixed) {
            throw new RuntimeException('Lot mixing is blocked. Different yarn lots cannot feed one warp without approval.');
        }
    }

    private function writeMove(StockLot $lot, string $signedQty, string $type, array $context): StockMove
    {
        $move = StockMove::query()->create([
            'stock_lot_id' => $lot->id,
            'warehouse_id' => $context['warehouse_id'] ?? $lot->warehouse_id,
            'bin_id' => $context['bin_id'] ?? null,
            'qty' => $signedQty,
            'uom' => $lot->uom,
            'unit_cost' => $lot->unit_cost,
            'move_type' => $type,
            'reference_type' => $context['reference_type'] ?? null,
            'reference_id' => $context['reference_id'] ?? null,
            'job_card_id' => $context['job_card_id'] ?? null,
            'mix_approved' => (bool) ($context['mix_approved'] ?? false),
            'narration' => $context['narration'] ?? null,
            'branch_id' => $lot->branch_id,
        ]);

        $balance = StockBalance::query()->firstOrCreate(
            ['warehouse_id' => $move->warehouse_id, 'stock_lot_id' => $lot->id],
            ['qty' => 0, 'value' => 0, 'branch_id' => $lot->branch_id],
        );
        $balance->qty = (string) BigDecimal::of((string) $balance->qty)->plus($signedQty)->toScale(3, RoundingMode::HALF_UP);
        $balance->value = (string) BigDecimal::of((string) $balance->qty)
            ->multipliedBy((string) $lot->unit_cost)
            ->toScale(2, RoundingMode::HALF_UP);
        $balance->save();

        return $move;
    }

    private function scale(string $qty): BigDecimal
    {
        return BigDecimal::of($qty)->toScale(3, RoundingMode::HALF_UP);
    }
}
