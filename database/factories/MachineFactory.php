<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Machine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Machine>
 */
class MachineFactory extends Factory
{
    protected $model = Machine::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'machine_type' => 'loom',
            'make' => fake()->words(3, true),
            'model_name' => fake()->words(3, true),
            'shed_mechanism' => fake()->words(3, true),
            'rpm' => 550,
            'reed_width_cm' => 190,
            'selectors' => 4,
            'year_installed' => 1,
            'motor_kw' => 0,
            'location' => fake()->words(3, true),
            'status' => 'running',
            'is_public' => false,
            'running_hours' => 0,
        ];
    }
}
