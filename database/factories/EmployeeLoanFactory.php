<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\EmployeeLoan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EmployeeLoan>
 */
class EmployeeLoanFactory extends Factory
{
    protected $model = EmployeeLoan::class;

    public function definition(): array
    {
        return [
            'principal' => 0,
            'balance' => 0,
            'installment' => 0,
            'status' => 'open',
        ];
    }
}
