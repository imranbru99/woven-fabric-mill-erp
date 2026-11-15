<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LoomSetup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LoomSetup>
 */
class LoomSetupFactory extends Factory
{
    protected $model = LoomSetup::class;

    public function definition(): array
    {
        return [
            'speed' => 0,
            'settings' => fake()->paragraph(),
            'setup_minutes' => 0,
            'started_at' => now(),
            'finished_at' => now(),
        ];
    }
}
