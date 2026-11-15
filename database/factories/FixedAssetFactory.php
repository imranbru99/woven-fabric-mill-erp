<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FixedAsset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FixedAsset>
 */
class FixedAssetFactory extends Factory
{
    protected $model = FixedAsset::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'acquired_on' => now()->toDateString(),
            'cost' => 0,
            'accumulated_depreciation' => 0,
            'method' => 'SLM',
            'rate_pct' => 10,
            'useful_life_months' => 120,
        ];
    }
}
