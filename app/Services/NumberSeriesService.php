<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\NumberSeries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NumberSeriesService
{
    public function next(string $documentType, ?int $branchId = null): string
    {
        return DB::transaction(function () use ($documentType, $branchId): string {
            $type = class_exists($documentType) ? class_basename($documentType) : $documentType;
            $year = (int) now()->year;

            $series = NumberSeries::query()
                ->where('document_type', $type)
                ->when($branchId, fn ($q) => $q->where('branch_id', $branchId))
                ->lockForUpdate()
                ->first();

            if (! $series) {
                $series = NumberSeries::query()->create([
                    'document_type' => $type,
                    'prefix' => strtoupper(substr($type, 0, 3)),
                    'next_number' => 1,
                    'padding' => 5,
                    'reset_rule' => 'yearly',
                    'year' => $year,
                    'branch_id' => $branchId,
                ]);
            }

            if ($series->reset_rule === 'yearly' && (int) $series->year !== $year) {
                $series->year = $year;
                $series->next_number = 1;
            }

            $number = sprintf('%s-%d-%s', $series->prefix, $series->year, str_pad((string) $series->next_number, (int) $series->padding, '0', STR_PAD_LEFT));
            $series->next_number = (int) $series->next_number + 1;
            $series->save();

            return $number;
        });
    }

    public function assign(Model $model): Model
    {
        if (empty($model->number)) {
            $model->number = $this->next($model::class, $model->getAttribute('branch_id'));
        }

        return $model;
    }
}
