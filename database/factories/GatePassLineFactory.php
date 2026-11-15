<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\GatePassLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GatePassLine>
 */
class GatePassLineFactory extends Factory
{
    protected $model = GatePassLine::class;

    public function definition(): array
    {
        return [
            'description' => fake()->words(3, true),
            'quantity' => 0,
            'uom' => 'kg',
        ];
    }
}
