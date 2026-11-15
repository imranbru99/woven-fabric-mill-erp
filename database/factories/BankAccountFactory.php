<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BankAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BankAccount>
 */
class BankAccountFactory extends Factory
{
    protected $model = BankAccount::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'account_no' => fake()->words(3, true),
            'bank_name' => fake()->words(3, true),
            'balance' => 0,
        ];
    }
}
