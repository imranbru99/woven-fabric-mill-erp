<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Spare;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Spare>
 */
class SpareFactory extends Factory
{
    protected $model = Spare::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'criticality' => 'B',
            'min_qty' => 0,
            'max_qty' => 0,
            'lead_time_days' => 15,
            'standard_cost' => 0,
        ];
    }
}
