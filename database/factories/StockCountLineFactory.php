<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\StockCountLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StockCountLine>
 */
class StockCountLineFactory extends Factory
{
    protected $model = StockCountLine::class;

    public function definition(): array
    {
        return [
            'book_qty' => 0,
            'physical_qty' => 0,
            'variance_qty' => 0,
        ];
    }
}
