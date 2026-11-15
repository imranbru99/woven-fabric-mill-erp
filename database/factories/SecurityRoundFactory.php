<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SecurityRound;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SecurityRound>
 */
class SecurityRoundFactory extends Factory
{
    protected $model = SecurityRound::class;

    public function definition(): array
    {
        return [
            'rounded_at' => now(),
            'area' => fake()->words(3, true),
            'ok' => true,
            'notes' => fake()->paragraph(),
        ];
    }
}
