<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LoomStoppage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LoomStoppage>
 */
class LoomStoppageFactory extends Factory
{
    protected $model = LoomStoppage::class;

    public function definition(): array
    {
        return [
            'reason_code' => 'unspecified',
            'reason_bn' => fake()->words(3, true),
            'started_at' => now(),
            'ended_at' => now(),
            'minutes' => 0,
            'source' => 'kiosk',
        ];
    }
}
