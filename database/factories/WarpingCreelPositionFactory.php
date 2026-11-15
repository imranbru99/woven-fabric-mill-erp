<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WarpingCreelPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WarpingCreelPosition>
 */
class WarpingCreelPositionFactory extends Factory
{
    protected $model = WarpingCreelPosition::class;

    public function definition(): array
    {
        return [
            'position_no' => 1,
            'cone_barcode' => fake()->words(3, true),
        ];
    }
}
