<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Recruitment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recruitment>
 */
class RecruitmentFactory extends Factory
{
    protected $model = Recruitment::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'title' => fake()->words(3, true),
            'openings' => 1,
            'closes_on' => now()->toDateString(),
            'is_public' => true,
        ];
    }
}
