<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SizingLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SizingLog>
 */
class SizingLogFactory extends Factory
{
    protected $model = SizingLog::class;

    public function definition(): array
    {
        return [
            'beam_no' => fake()->words(3, true),
            'warp_length_m' => 0,
            'speed' => 0,
            'size_box_temp' => 0,
            'squeeze_pressure' => 0,
        ];
    }
}
