<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\JobworkChallan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobworkChallan>
 */
class JobworkChallanFactory extends Factory
{
    protected $model = JobworkChallan::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'direction' => 'out',
            'metres' => 0,
            'challan_date' => now()->toDateString(),
        ];
    }
}
