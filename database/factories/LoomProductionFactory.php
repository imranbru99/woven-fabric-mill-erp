<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LoomProduction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LoomProduction>
 */
class LoomProductionFactory extends Factory
{
    protected $model = LoomProduction::class;

    public function definition(): array
    {
        return [
            'production_date' => now()->toDateString(),
            'picks' => 0,
            'rpm' => 0,
            'minutes' => 480,
            'efficiency' => 0,
            'metres' => 0,
            'warp_breaks' => 0,
            'weft_breaks' => 0,
            'stoppage_minutes' => 0,
            'source' => 'kiosk',
        ];
    }
}
