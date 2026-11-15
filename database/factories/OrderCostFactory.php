<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\OrderCost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<OrderCost>
 */
class OrderCostFactory extends Factory
{
    protected $model = OrderCost::class;

    public function definition(): array
    {
        return [
            'metres' => 0,
            'yarn' => 0,
            'sizing' => 0,
            'warping' => 0,
            'drawing' => 0,
            'weaving' => 0,
            'finishing' => 0,
            'packing' => 0,
            'wastage' => 0,
            'overhead' => 0,
            'total' => 0,
            'cost_per_metre' => 0,
            'revenue' => 0,
            'profit' => 0,
        ];
    }
}
