<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Meeting>
 */
class MeetingFactory extends Factory
{
    protected $model = Meeting::class;

    public function definition(): array
    {
        return [
            'met_at' => now(),
            'subject' => fake()->words(3, true),
            'minutes' => fake()->paragraph(),
        ];
    }
}
