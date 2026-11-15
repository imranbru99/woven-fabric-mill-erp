<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Depreciation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Depreciation>
 */
class DepreciationFactory extends Factory
{
    protected $model = Depreciation::class;

    public function definition(): array
    {
        return [
            'period_date' => now()->toDateString(),
            'amount' => 0,
        ];
    }
}
