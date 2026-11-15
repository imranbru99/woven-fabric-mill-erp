<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Cheque;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cheque>
 */
class ChequeFactory extends Factory
{
    protected $model = Cheque::class;

    public function definition(): array
    {
        return [
            'cheque_no' => fake()->words(3, true),
            'direction' => 'in',
            'amount' => 0,
            'cheque_date' => now()->toDateString(),
            'status' => 'pending',
            'is_pdc' => false,
        ];
    }
}
