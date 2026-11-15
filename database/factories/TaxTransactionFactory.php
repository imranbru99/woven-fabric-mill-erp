<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TaxTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TaxTransaction>
 */
class TaxTransactionFactory extends Factory
{
    protected $model = TaxTransaction::class;

    public function definition(): array
    {
        return [
            'source_type' => fake()->words(3, true),
            'source_id' => 1,
            'direction' => 'output',
            'base_amount' => 0,
            'tax_amount' => 0,
            'tax_date' => now()->toDateString(),
            'form_code' => fake()->words(3, true),
        ];
    }
}
