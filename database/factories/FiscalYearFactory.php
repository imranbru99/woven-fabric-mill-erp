<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FiscalYear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FiscalYear>
 */
class FiscalYearFactory extends Factory
{
    protected $model = FiscalYear::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'starts_on' => now()->toDateString(),
            'ends_on' => now()->toDateString(),
            'is_closed' => false,
        ];
    }
}
