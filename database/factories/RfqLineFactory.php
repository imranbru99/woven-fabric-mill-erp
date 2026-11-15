<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\RfqLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RfqLine>
 */
class RfqLineFactory extends Factory
{
    protected $model = RfqLine::class;

    public function definition(): array
    {
        return [
            'description' => fake()->words(3, true),
            'quantity' => 0,
            'uom' => 'kg',
        ];
    }
}
