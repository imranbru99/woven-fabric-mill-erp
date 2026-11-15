<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\GoodsReceiptLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GoodsReceiptLine>
 */
class GoodsReceiptLineFactory extends Factory
{
    protected $model = GoodsReceiptLine::class;

    public function definition(): array
    {
        return [
            'item_type' => 'yarn',
            'item_id' => 1,
            'lot_no' => fake()->unique()->bothify('??-#####'),
            'quantity' => 0,
            'accepted_qty' => 0,
            'rejected_qty' => 0,
            'uom' => 'kg',
            'unit_cost' => 0,
            'qc_status' => 'quarantine',
        ];
    }
}
