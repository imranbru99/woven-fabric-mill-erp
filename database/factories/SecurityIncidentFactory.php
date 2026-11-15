<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SecurityIncident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SecurityIncident>
 */
class SecurityIncidentFactory extends Factory
{
    protected $model = SecurityIncident::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'occurred_at' => now(),
            'severity' => 'low',
            'description' => fake()->paragraph(),
            'cctv_ref' => fake()->words(3, true),
        ];
    }
}
