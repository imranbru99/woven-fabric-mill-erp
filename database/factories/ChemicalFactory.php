<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Chemical;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Chemical>
 */
class ChemicalFactory extends Factory
{
    protected $model = Chemical::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'kind' => 'size',
            'uom' => 'kg',
            'standard_cost' => 0,
            'shelf_life_days' => 180,
            'reorder_qty' => 0,
        ];
    }
}
