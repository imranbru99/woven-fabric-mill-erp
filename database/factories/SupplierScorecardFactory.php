<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SupplierScorecard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SupplierScorecard>
 */
class SupplierScorecardFactory extends Factory
{
    protected $model = SupplierScorecard::class;

    public function definition(): array
    {
        return [
            'period_start' => now()->toDateString(),
            'period_end' => now()->toDateString(),
            'quality_score' => 0,
            'delivery_score' => 0,
            'price_score' => 0,
            'claim_score' => 0,
            'total_score' => 0,
        ];
    }
}
