<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PmSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PmSchedule>
 */
class PmScheduleFactory extends Factory
{
    protected $model = PmSchedule::class;

    public function definition(): array
    {
        return [
            'frequency' => 'weekly',
            'every_hours' => 0,
            'next_due' => now()->toDateString(),
            'is_active' => true,
        ];
    }
}
