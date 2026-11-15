<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FollowUp;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FollowUp>
 */
class FollowUpFactory extends Factory
{
    protected $model = FollowUp::class;

    public function definition(): array
    {
        return [
            'due_on' => now()->toDateString(),
            'channel' => 'phone',
            'notes' => fake()->paragraph(),
            'is_done' => false,
        ];
    }
}
