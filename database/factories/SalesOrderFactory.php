<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SalesOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SalesOrder>
 */
class SalesOrderFactory extends Factory
{
    protected $model = SalesOrder::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'order_date' => now()->toDateString(),
            'delivery_date' => now()->toDateString(),
            'tolerance_pct' => 5,
            'total' => 0,
            'margin_pct' => 0,
            'feasibility' => [],
        ];
    }
}
