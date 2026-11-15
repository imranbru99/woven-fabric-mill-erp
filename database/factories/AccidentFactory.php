<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Accident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Accident>
 */
class AccidentFactory extends Factory
{
    protected $model = Accident::class;

    public function definition(): array
    {
        return [
            'occurred_at' => now(),
            'severity' => 'minor',
            'description' => fake()->paragraph(),
            'action_taken' => fake()->paragraph(),
        ];
    }
}
