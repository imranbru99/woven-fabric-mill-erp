<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

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
            'instrument_no' => fake()->words(3, true),
            'paid_on' => now()->toDateString(),
        ];
    }
}
