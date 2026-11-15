<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\GatePass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GatePass>
 */
class GatePassFactory extends Factory
{
    protected $model = GatePass::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'direction' => 'out',
            'vehicle_no' => fake()->words(3, true),
            'driver' => fake()->words(3, true),
            'purpose' => fake()->words(3, true),
            'reference_type' => fake()->words(3, true),
            'reference_id' => 1,
            'gross_weight' => 0,
            'tare_weight' => 0,
            'qr_token' => fake()->words(3, true),
            'returnable' => false,
        ];
    }
}
