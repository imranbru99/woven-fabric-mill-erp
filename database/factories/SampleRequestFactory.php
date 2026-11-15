<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SampleRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SampleRequest>
 */
class SampleRequestFactory extends Factory
{
    protected $model = SampleRequest::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'sample_type' => 'handloom',
            'shade' => fake()->words(3, true),
            'quantity_m' => 0,
            'due_on' => now()->toDateString(),
        ];
    }
}
