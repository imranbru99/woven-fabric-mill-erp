<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BudgetLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BudgetLine>
 */
class BudgetLineFactory extends Factory
{
    protected $model = BudgetLine::class;

    public function definition(): array
    {
        return [
            'period' => fake()->words(3, true),
            'amount' => 0,
            'actual' => 0,
        ];
    }
}
