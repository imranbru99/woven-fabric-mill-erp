<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SizingBatch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SizingBatch>
 */
class SizingBatchFactory extends Factory
{
    protected $model = SizingBatch::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'cooked_at' => now(),
            'viscosity' => 0,
            'concentration' => 0,
            'pickup_target' => 10,
            'pickup_actual' => 0,
            'moisture' => 0,
            'stretch_pct' => 0,
            'speed' => 0,
            'steam_pressure' => 0,
            'chemical_kg' => 0,
            'cost' => 0,
        ];
    }
}
