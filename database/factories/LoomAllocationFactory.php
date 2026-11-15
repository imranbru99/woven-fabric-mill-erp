<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LoomAllocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LoomAllocation>
 */
class LoomAllocationFactory extends Factory
{
    protected $model = LoomAllocation::class;

    public function definition(): array
    {
        return [
            'start_date' => now()->toDateString(),
            'end_date' => now()->toDateString(),
            'planned_metres' => 0,
            'style_change_minutes' => 0,
            'status' => 'planned',
        ];
    }
}
