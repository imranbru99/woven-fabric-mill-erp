<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ExchangeRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ExchangeRate>
 */
class ExchangeRateFactory extends Factory
{
    protected $model = ExchangeRate::class;

    public function definition(): array
    {
        return [
            'currency_id' => \App\Models\Currency::factory(),
            'rate_date' => now()->toDateString(),
            'rate' => 0,
            'source' => 'manual',
        ];
    }
}
