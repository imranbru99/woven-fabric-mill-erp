<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProductionPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductionPlan>
 */
class ProductionPlanFactory extends Factory
{
    protected $model = ProductionPlan::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'start_date' => now()->toDateString(),
            'end_date' => now()->toDateString(),
            'notes' => fake()->paragraph(),
        ];
    }
}
