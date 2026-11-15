<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LandedCost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LandedCost>
 */
class LandedCostFactory extends Factory
{
    protected $model = LandedCost::class;

    public function definition(): array
    {
        return [
            'invoice_amount' => 0,
            'freight' => 0,
            'insurance' => 0,
            'duty' => 0,
            'port_charges' => 0,
            'cf_charges' => 0,
            'quantity' => 0,
            'unit_cost' => 0,
        ];
    }
}
