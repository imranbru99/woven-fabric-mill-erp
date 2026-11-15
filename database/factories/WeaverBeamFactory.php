<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WeaverBeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WeaverBeam>
 */
class WeaverBeamFactory extends Factory
{
    protected $model = WeaverBeam::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'length_m' => 0,
            'leftover_m' => 0,
            'ends' => 0,
            'size_addon_pct' => 0,
            'gross_kg' => 0,
            'net_kg' => 0,
            'grade' => 'A',
            'position' => 'store',
        ];
    }
}
