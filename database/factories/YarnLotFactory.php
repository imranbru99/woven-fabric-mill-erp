<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\YarnLot;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<YarnLot>
 */
class YarnLotFactory extends Factory
{
    protected $model = YarnLot::class;

    public function definition(): array
    {
        return [
            'lot_no' => fake()->unique()->bothify('??-#####'),
            'qty_kg' => 0,
            'unit_cost' => 0,
            'status' => 'available',
            'received_on' => now()->toDateString(),
        ];
    }
}
