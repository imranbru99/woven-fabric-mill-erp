<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Incoterm;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Incoterm>
 */
class IncotermFactory extends Factory
{
    protected $model = Incoterm::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
        ];
    }
}
