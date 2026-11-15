<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TestPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TestPackage>
 */
class TestPackageFactory extends Factory
{
    protected $model = TestPackage::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'standard' => 'ISO',
        ];
    }
}
