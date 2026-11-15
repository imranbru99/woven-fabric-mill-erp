<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FabricRoll;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FabricRoll>
 */
class FabricRollFactory extends Factory
{
    protected $model = FabricRoll::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'length_m' => 0,
            'weight_kg' => 0,
            'grey_width_cm' => 0,
            'gsm' => 0,
            'grade' => fake()->words(3, true),
            'points' => 0,
            'inspection_system' => '4-point',
            'status' => 'grey',
            'doffed_at' => now(),
            'barcode' => fake()->words(3, true),
        ];
    }
}
