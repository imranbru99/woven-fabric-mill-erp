<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\StockLot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockLot>
 */
class StockLotFactory extends Factory
{
    protected $model = StockLot::class;

    public function definition(): array
    {
        return [
            'item_type' => fake()->words(3, true),
            'item_id' => 1,
            'lot_no' => fake()->unique()->bothify('??-#####'),
            'qty' => 0,
            'reserved_qty' => 0,
            'uom' => 'kg',
            'unit_cost' => 0,
            'status' => 'quarantine',
            'expiry_date' => now()->toDateString(),
            'hold_reason' => fake()->words(3, true),
        ];
    }
}
