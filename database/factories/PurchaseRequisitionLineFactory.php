<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PurchaseRequisitionLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PurchaseRequisitionLine>
 */
class PurchaseRequisitionLineFactory extends Factory
{
    protected $model = PurchaseRequisitionLine::class;

    public function definition(): array
    {
        return [
            'item_type' => 'yarn',
            'item_id' => 1,
            'description' => fake()->words(3, true),
            'quantity' => 0,
            'uom' => 'kg',
            'estimated_rate' => 0,
        ];
    }
}
