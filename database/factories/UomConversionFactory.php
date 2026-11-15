<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UomConversion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UomConversion>
 */
class UomConversionFactory extends Factory
{
    protected $model = UomConversion::class;

    public function definition(): array
    {
        return [
            'from_uom_id' => \App\Models\UnitOfMeasure::factory(),
            'to_uom_id' => \App\Models\UnitOfMeasure::factory(),
            'factor' => 1,
        ];
    }
}
