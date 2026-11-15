<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LabTestResult;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LabTestResult>
 */
class LabTestResultFactory extends Factory
{
    protected $model = LabTestResult::class;

    public function definition(): array
    {
        return [
            'parameter' => fake()->words(3, true),
            'value' => fake()->words(3, true),
            'unit' => fake()->words(3, true),
            'min_limit' => '0',
            'max_limit' => '0',
            'passed' => false,
        ];
    }
}
