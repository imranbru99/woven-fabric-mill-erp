<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\StockBalance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockBalance>
 */
class StockBalanceFactory extends Factory
{
    protected $model = StockBalance::class;

    public function definition(): array
    {
        return [
            'qty' => 0,
            'value' => 0,
        ];
    }
}
