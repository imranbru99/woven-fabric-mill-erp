<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Bin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bin>
 */
class BinFactory extends Factory
{
    protected $model = Bin::class;

    public function definition(): array
    {
        return [
            'warehouse_id' => \App\Models\Warehouse::factory(),
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
        ];
    }
}
