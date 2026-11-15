<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FiscalPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FiscalPeriod>
 */
class FiscalPeriodFactory extends Factory
{
    protected $model = FiscalPeriod::class;

    public function definition(): array
    {
        return [
            'fiscal_year_id' => \App\Models\FiscalYear::factory(),
            'name' => fake()->words(3, true),
            'starts_on' => now()->toDateString(),
            'ends_on' => now()->toDateString(),
            'is_locked' => false,
        ];
    }
}
