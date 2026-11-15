<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TestLimit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TestLimit>
 */
class TestLimitFactory extends Factory
{
    protected $model = TestLimit::class;

    public function definition(): array
    {
        return [
            'parameter' => fake()->words(3, true),
            'unit' => fake()->words(3, true),
            'min_value' => '0',
            'max_value' => '0',
        ];
    }
}
