<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Budget;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Budget>
 */
class BudgetFactory extends Factory
{
    protected $model = Budget::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'amount' => 0,
            'status' => 'draft',
        ];
    }
}
