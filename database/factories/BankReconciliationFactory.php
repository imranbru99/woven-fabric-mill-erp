<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BankReconciliation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BankReconciliation>
 */
class BankReconciliationFactory extends Factory
{
    protected $model = BankReconciliation::class;

    public function definition(): array
    {
        return [
            'statement_date' => now()->toDateString(),
            'statement_balance' => 0,
            'book_balance' => 0,
            'difference' => 0,
            'status' => 'open',
        ];
    }
}
