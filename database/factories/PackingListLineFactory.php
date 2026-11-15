<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PackingListLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PackingListLine>
 */
class PackingListLineFactory extends Factory
{
    protected $model = PackingListLine::class;

    public function definition(): array
    {
        return [
            'carton_no' => fake()->words(3, true),
            'metres' => 0,
            'net_kg' => 0,
            'gross_kg' => 0,
        ];
    }
}
