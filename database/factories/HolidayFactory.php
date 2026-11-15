<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Holiday;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Holiday>
 */
class HolidayFactory extends Factory
{
    protected $model = Holiday::class;

    public function definition(): array
    {
        return [
            'holiday_date' => now()->toDateString(),
            'name' => fake()->words(3, true),
            'name_bn' => fake()->words(3, true),
            'paid' => true,
        ];
    }
}
