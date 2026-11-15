<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Receipt;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Receipt>
 */
class ReceiptFactory extends Factory
{
    protected $model = Receipt::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'amount' => 0,
            'currency_code' => 'BDT',
            'method' => 'bank',
            'received_on' => now()->toDateString(),
        ];
    }
}
