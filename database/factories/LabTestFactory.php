<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LabTest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LabTest>
 */
class LabTestFactory extends Factory
{
    protected $model = LabTest::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'sample_type' => 'yarn',
            'related_type' => fake()->words(3, true),
            'related_id' => 1,
            'result' => 'pending',
            'tested_at' => now(),
        ];
    }
}
