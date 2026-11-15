<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WarpingJob;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WarpingJob>
 */
class WarpingJobFactory extends Factory
{
    protected $model = WarpingJob::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'ends' => 0,
            'beam_length_m' => 0,
            'speed' => 0,
            'stops' => 0,
            'breakage_per_million' => 0,
            'yarn_issued_kg' => 0,
            'yarn_consumed_kg' => 0,
            'soft_waste_kg' => 0,
            'hard_waste_kg' => 0,
        ];
    }
}
