<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Shipment>
 */
class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'bl_number' => fake()->words(3, true),
            'container_no' => fake()->words(3, true),
            'etd' => now()->toDateString(),
            'eta' => now()->toDateString(),
        ];
    }
}
