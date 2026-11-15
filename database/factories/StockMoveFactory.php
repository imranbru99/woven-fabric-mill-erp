<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\StockMove;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockMove>
 */
class StockMoveFactory extends Factory
{
    protected $model = StockMove::class;

    public function definition(): array
    {
        return [
            'qty' => 0,
            'uom' => 'kg',
            'unit_cost' => 0,
            'move_type' => 'grn',
            'reference_type' => fake()->words(3, true),
            'reference_id' => 1,
            'mix_approved' => false,
            'narration' => fake()->words(3, true),
        ];
    }
}
