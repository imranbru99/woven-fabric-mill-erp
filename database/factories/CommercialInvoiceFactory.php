<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CommercialInvoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CommercialInvoice>
 */
class CommercialInvoiceFactory extends Factory
{
    protected $model = CommercialInvoice::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'invoice_date' => now()->toDateString(),
            'amount' => 0,
            'vat' => 0,
            'total' => 0,
            'mushak_form' => fake()->words(3, true),
            'is_export' => false,
        ];
    }
}
