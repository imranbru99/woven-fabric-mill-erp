<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PurchaseOrderLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PurchaseOrderLine>
 */
class PurchaseOrderLineFactory extends Factory
{
    protected $model = PurchaseOrderLine::class;

    public function definition(): array
    {
        return [
            'item_type' => 'yarn',
            'item_id' => 1,
            'description' => fake()->words(3, true),
            'quantity' => 0,
            'received_qty' => 0,
            'uom' => 'kg',
            'rate' => 0,
            'amount' => 0,
        ];
    }
}
