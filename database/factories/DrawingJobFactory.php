<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\DrawingJob;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DrawingJob>
 */
class DrawingJobFactory extends Factory
{
    protected $model = DrawingJob::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'method' => 'fresh',
            'wrong_draws' => 0,
            'double_ends' => 0,
        ];
    }
}
