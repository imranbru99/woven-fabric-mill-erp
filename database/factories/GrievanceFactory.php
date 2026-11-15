<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Grievance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Grievance>
 */
class GrievanceFactory extends Factory
{
    protected $model = Grievance::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'subject' => fake()->words(3, true),
            'body' => fake()->paragraph(),
            'anonymous' => false,
        ];
    }
}
