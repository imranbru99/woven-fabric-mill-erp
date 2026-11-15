<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommercialInvoiceLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CommercialInvoiceLine>
 */
class CommercialInvoiceLineFactory extends Factory
{
    protected $model = CommercialInvoiceLine::class;

    public function definition(): array
    {
        return [
            'description' => fake()->words(3, true),
            'quantity' => 0,
            'uom' => 'm',
            'rate' => 0,
            'amount' => 0,
        ];
    }
}
