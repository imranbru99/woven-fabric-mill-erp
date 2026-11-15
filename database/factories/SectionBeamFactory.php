<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SectionBeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SectionBeam>
 */
class SectionBeamFactory extends Factory
{
    protected $model = SectionBeam::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'ends' => 0,
            'length_m' => 0,
            'gross_kg' => 0,
            'net_kg' => 0,
            'status' => 'in_stock',
        ];
    }
}
