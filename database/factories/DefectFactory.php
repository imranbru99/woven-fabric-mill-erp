<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Defect;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Defect>
 */
class DefectFactory extends Factory
{
    protected $model = Defect::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'name_bn' => fake()->words(3, true),
            'system' => 'both',
            'cause_category' => 'weaving',
            'corrective_action' => fake()->paragraph(),
        ];
    }
}
