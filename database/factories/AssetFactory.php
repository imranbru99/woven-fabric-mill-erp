<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Asset>
 */
class AssetFactory extends Factory
{
    protected $model = Asset::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'category' => 'loom',
            'commissioned_on' => now()->toDateString(),
            'warranty_until' => now()->toDateString(),
            'manual_ref' => fake()->paragraph(),
        ];
    }
}
