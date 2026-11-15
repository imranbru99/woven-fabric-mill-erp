<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Reed;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reed>
 */
class ReedFactory extends Factory
{
    protected $model = Reed::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'reed_count' => 0,
            'reed_space_cm' => 0,
            'status' => 'in_stock',
            'wear_score' => 0,
        ];
    }
}
