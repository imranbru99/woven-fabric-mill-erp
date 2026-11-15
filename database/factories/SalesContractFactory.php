<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SalesContract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SalesContract>
 */
class SalesContractFactory extends Factory
{
    protected $model = SalesContract::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'contract_no' => fake()->words(3, true),
            'contract_date' => now()->toDateString(),
            'amount' => 0,
            'currency_code' => 'USD',
        ];
    }
}
