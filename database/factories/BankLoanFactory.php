<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BankLoan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BankLoan>
 */
class BankLoanFactory extends Factory
{
    protected $model = BankLoan::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'loan_type' => 'CC',
            'principal' => 0,
            'interest_pct' => 9,
            'tenure_months' => 12,
            'emi' => 0,
            'starts_on' => now()->toDateString(),
        ];
    }
}
