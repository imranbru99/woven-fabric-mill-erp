<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobApplication>
 */
class JobApplicationFactory extends Factory
{
    protected $model = JobApplication::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->words(3, true),
            'cover_letter' => fake()->paragraph(),
            'status' => 'received',
        ];
    }
}
