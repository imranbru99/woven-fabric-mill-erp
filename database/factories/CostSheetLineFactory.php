<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CostSheetLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CostSheetLine>
 */
class CostSheetLineFactory extends Factory
{
    protected $model = CostSheetLine::class;

    public function definition(): array
    {
        return [
            'component' => fake()->words(3, true),
            'rate' => 0,
            'quantity' => 0,
            'amount' => 0,
        ];
    }
}
