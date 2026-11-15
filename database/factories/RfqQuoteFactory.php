<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\RfqQuote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RfqQuote>
 */
class RfqQuoteFactory extends Factory
{
    protected $model = RfqQuote::class;

    public function definition(): array
    {
        return [
            'rate' => 0,
            'delivery_days' => 0,
            'quality_score' => 0,
            'rank' => 0,
            'is_selected' => false,
        ];
    }
}
