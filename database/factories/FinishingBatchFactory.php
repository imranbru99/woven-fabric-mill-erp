<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FinishingBatch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FinishingBatch>
 */
class FinishingBatchFactory extends Factory
{
    protected $model = FinishingBatch::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'process_route' => 'jobwork',
            'shade' => fake()->words(3, true),
            'grey_m' => 0,
            'finished_m' => 0,
            'process_loss_pct' => 0,
            'rate_per_m' => 0,
            'cost' => 0,
            'is_reprocess' => false,
        ];
    }
}
