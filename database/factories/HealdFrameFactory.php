<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\HealdFrame;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HealdFrame>
 */
class HealdFrameFactory extends Factory
{
    protected $model = HealdFrame::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'frame_no' => 1,
            'wire_count' => 0,
            'status' => 'in_stock',
        ];
    }
}
