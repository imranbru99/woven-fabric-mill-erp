<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\QuotationLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuotationLine>
 */
class QuotationLineFactory extends Factory
{
    protected $model = QuotationLine::class;

    public function definition(): array
    {
        return [
            'shade' => fake()->words(3, true),
            'quantity' => 0,
            'uom' => 'm',
            'rate' => 0,
            'amount' => 0,
            'delivery_date' => now()->toDateString(),
        ];
    }
}
