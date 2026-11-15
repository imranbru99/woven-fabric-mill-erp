<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\RollDefect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RollDefect>
 */
class RollDefectFactory extends Factory
{
    protected $model = RollDefect::class;

    public function definition(): array
    {
        return [
            'position_m' => 0,
            'length_inch' => 1,
            'points' => 1,
            'photo_path' => fake()->words(3, true),
            'human_confirmed' => true,
        ];
    }
}
