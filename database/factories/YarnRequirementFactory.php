<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\YarnRequirement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<YarnRequirement>
 */
class YarnRequirementFactory extends Factory
{
    protected $model = YarnRequirement::class;

    public function definition(): array
    {
        return [
            'direction' => 'warp',
            'required_kg' => 0,
            'available_kg' => 0,
            'shortage_kg' => 0,
        ];
    }
}
