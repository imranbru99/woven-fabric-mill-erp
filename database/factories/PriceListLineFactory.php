<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PriceListLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PriceListLine>
 */
class PriceListLineFactory extends Factory
{
    protected $model = PriceListLine::class;

    public function definition(): array
    {
        return [
            'rate' => 0,
            'discount_pct' => 0,
        ];
    }
}
