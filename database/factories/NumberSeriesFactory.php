<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\NumberSeries;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NumberSeries>
 */
class NumberSeriesFactory extends Factory
{
    protected $model = NumberSeries::class;

    public function definition(): array
    {
        return [
            'document_type' => fake()->words(3, true),
            'prefix' => 'DOC',
            'next_number' => 1,
            'padding' => 5,
            'reset_rule' => 'yearly',
            'year' => 2026,
        ];
    }
}
