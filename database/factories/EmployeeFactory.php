<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'nid' => fake()->words(3, true),
            'employment_type' => 'worker',
            'designation' => fake()->words(3, true),
            'grade' => fake()->words(3, true),
            'join_date' => now()->toDateString(),
            'skill_level' => 1,
            'basic_salary' => 0,
            'bank_account' => fake()->words(3, true),
            'payment_channel' => 'bank',
            'is_active' => true,
        ];
    }
}
