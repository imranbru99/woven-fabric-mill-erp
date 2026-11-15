<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Instrument;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Instrument>
 */
class InstrumentFactory extends Factory
{
    protected $model = Instrument::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'calibrated_on' => now()->toDateString(),
            'calibration_due' => now()->toDateString(),
            'certificate_no' => fake()->words(3, true),
        ];
    }
}
