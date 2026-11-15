<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UtilityReading;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UtilityReading>
 */
class UtilityReadingFactory extends Factory
{
    protected $model = UtilityReading::class;

    public function definition(): array
    {
        return [
            'reading_date' => now()->toDateString(),
            'utility' => 'power',
            'reading_value' => 0,
            'uom' => 'kWh',
            'cost' => 0,
            'metres_produced' => 0,
            'cost_per_metre' => 0,
        ];
    }
}
