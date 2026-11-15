<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PackingMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PackingMaterial>
 */
class PackingMaterialFactory extends Factory
{
    protected $model = PackingMaterial::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'kind' => 'carton',
            'standard_cost' => 0,
        ];
    }
}
