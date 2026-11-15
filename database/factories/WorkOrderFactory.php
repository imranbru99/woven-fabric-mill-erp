<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WorkOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkOrder>
 */
class WorkOrderFactory extends Factory
{
    protected $model = WorkOrder::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'work_type' => 'breakdown',
            'started_at' => now(),
            'ended_at' => now(),
            'downtime_minutes' => 0,
            'root_cause' => fake()->paragraph(),
            'cost' => 0,
        ];
    }
}
