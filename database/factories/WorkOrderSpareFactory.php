<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WorkOrderSpare;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WorkOrderSpare>
 */
class WorkOrderSpareFactory extends Factory
{
    protected $model = WorkOrderSpare::class;

    public function definition(): array
    {
        return [
            'quantity' => 0,
            'cost' => 0,
        ];
    }
}
