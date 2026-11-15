<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\StockTransferLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockTransferLine>
 */
class StockTransferLineFactory extends Factory
{
    protected $model = StockTransferLine::class;

    public function definition(): array
    {
        return [
            'quantity' => 0,
        ];
    }
}
