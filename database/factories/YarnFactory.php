<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Yarn;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Yarn>
 */
class YarnFactory extends Factory
{
    protected $model = Yarn::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'count_value' => 40,
            'count_system' => 'Ne',
            'yarn_type' => 'combed',
            'cotton_pct' => 100,
            'poly_pct' => 0,
            'viscose_pct' => 0,
            'twist_direction' => 'Z',
            'ply' => 1,
            'origin' => fake()->words(3, true),
            'mill_brand' => fake()->words(3, true),
            'colour' => 'raw-white',
            'cone_weight_kg' => 2.083,
            'is_filament' => false,
            'standard_cost' => 0,
            'reorder_kg' => 0,
        ];
    }
}
