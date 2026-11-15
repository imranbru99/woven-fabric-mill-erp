<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition(): array
    {
        return [
            'work_date' => now()->toDateString(),
            'in_at' => now(),
            'out_at' => now(),
            'late_minutes' => 0,
            'ot_minutes' => 0,
            'status' => 'present',
            'source' => 'manual',
        ];
    }
}
