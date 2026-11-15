<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SalesOrderLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SalesOrderLine>
 */
class SalesOrderLineFactory extends Factory
{
    protected $model = SalesOrderLine::class;

    public function definition(): array
    {
        return [
            'shade' => fake()->words(3, true),
            'width_cm' => 0,
            'quantity' => 0,
            'uom' => 'm',
            'rate' => 0,
            'amount' => 0,
            'delivery_date' => now()->toDateString(),
            'tolerance_pct' => 5,
            'produced_qty' => 0,
            'dispatched_qty' => 0,
        ];
    }
}
