<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\AmcContract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AmcContract>
 */
class AmcContractFactory extends Factory
{
    protected $model = AmcContract::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'asset_scope' => fake()->words(3, true),
            'starts_on' => now()->toDateString(),
            'ends_on' => now()->toDateString(),
            'annual_value' => 0,
        ];
    }
}
