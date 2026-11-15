<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CostCentre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CostCentre>
 */
class CostCentreFactory extends Factory
{
    protected $model = CostCentre::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'type' => 'department',
        ];
    }
}
