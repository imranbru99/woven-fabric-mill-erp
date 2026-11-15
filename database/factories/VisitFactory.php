<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Visit>
 */
class VisitFactory extends Factory
{
    protected $model = Visit::class;

    public function definition(): array
    {
        return [
            'visited_on' => now()->toDateString(),
            'location' => fake()->words(3, true),
            'notes' => fake()->paragraph(),
        ];
    }
}
