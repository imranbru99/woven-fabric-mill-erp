<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\FabricRoll;
use App\Models\LoomProduction;
use App\Models\SizingBatch;
use App\Models\WeaverBeam;
use App\Models\YarnLot;

class TraceabilityService
{
    /** @return array<string, mixed> */
    public function fromRoll(string $number): array
    {
        $roll = FabricRoll::query()->where('number', $number)->firstOrFail();
        $beam = $roll->weaver_beam_id ? WeaverBeam::query()->find($roll->weaver_beam_id) : null;
        $sizing = $roll->sizing_batch_id ? SizingBatch::query()->find($roll->sizing_batch_id) : null;
        $production = LoomProduction::query()->where('job_card_id', $roll->job_card_id)->where('loom_id', $roll->loom_id)->first();

        return [
            'roll' => $roll->number,
            'grade' => $roll->grade,
            'loom_id' => $roll->loom_id,
            'operator_id' => $roll->operator_id,
            'beam' => $beam?->number,
            'sizing_batch' => $sizing?->number,
            'warp_lot' => $roll->warp_lot_id ? YarnLot::query()->find($roll->warp_lot_id)?->lot_no : null,
            'weft_lot' => $roll->weft_lot_id ? YarnLot::query()->find($roll->weft_lot_id)?->lot_no : null,
            'picks' => $production?->picks,
            'efficiency' => $production?->efficiency,
        ];
    }
}
