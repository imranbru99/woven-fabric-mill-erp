<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WageRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WageRate>
 */
class WageRateFactory extends Factory
{
    protected $model = WageRate::class;

    public function definition(): array
    {
        return [
            'basis' => 'per_metre',
            'rate' => 0,
            'effective_from' => now()->toDateString(),
        ];
    }
}
