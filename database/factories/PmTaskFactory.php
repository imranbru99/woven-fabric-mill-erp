<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PmTask;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PmTask>
 */
class PmTaskFactory extends Factory
{
    protected $model = PmTask::class;

    public function definition(): array
    {
        return [
            'task' => fake()->words(3, true),
            'is_done' => false,
            'done_on' => now()->toDateString(),
        ];
    }
}
