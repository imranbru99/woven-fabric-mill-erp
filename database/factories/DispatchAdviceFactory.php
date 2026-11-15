<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\DispatchAdvice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DispatchAdvice>
 */
class DispatchAdviceFactory extends Factory
{
    protected $model = DispatchAdvice::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'dispatch_date' => now()->toDateString(),
            'vehicle_no' => fake()->words(3, true),
            'metres' => 0,
        ];
    }
}
