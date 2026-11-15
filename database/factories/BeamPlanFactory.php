<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BeamPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BeamPlan>
 */
class BeamPlanFactory extends Factory
{
    protected $model = BeamPlan::class;

    public function definition(): array
    {
        return [
            'warp_length_m' => 0,
            'ends' => 0,
            'beam_count' => 1,
            'beam_length_m' => 0,
            'cones' => 0,
        ];
    }
}
