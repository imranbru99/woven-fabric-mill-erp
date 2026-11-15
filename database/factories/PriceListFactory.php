<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PriceList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PriceList>
 */
class PriceListFactory extends Factory
{
    protected $model = PriceList::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'valid_from' => now()->toDateString(),
            'valid_to' => now()->toDateString(),
            'is_active' => true,
        ];
    }
}
