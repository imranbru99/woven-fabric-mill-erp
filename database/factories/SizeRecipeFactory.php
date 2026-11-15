<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SizeRecipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SizeRecipe>
 */
class SizeRecipeFactory extends Factory
{
    protected $model = SizeRecipe::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'target_pickup_pct' => 10,
            'notes' => fake()->paragraph(),
        ];
    }
}
