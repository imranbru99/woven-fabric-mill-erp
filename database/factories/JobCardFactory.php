<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\JobCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobCard>
 */
class JobCardFactory extends Factory
{
    protected $model = JobCard::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'stage' => 'warping',
            'qty_m' => 0,
            'barcode' => fake()->words(3, true),
        ];
    }
}
