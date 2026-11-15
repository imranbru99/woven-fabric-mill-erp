<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Shift;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shift>
 */
class ShiftFactory extends Factory
{
    protected $model = Shift::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'starts_at' => '08:00:00',
            'ends_at' => '08:00:00',
            'break_minutes' => 0,
            'is_night' => false,
        ];
    }
}
