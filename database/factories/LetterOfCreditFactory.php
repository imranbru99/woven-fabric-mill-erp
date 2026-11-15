<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LetterOfCredit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LetterOfCredit>
 */
class LetterOfCreditFactory extends Factory
{
    protected $model = LetterOfCredit::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'lc_type' => 'export',
            'lc_number' => fake()->words(3, true),
            'amount' => 0,
            'utilised' => 0,
            'currency_code' => 'USD',
            'expiry_date' => now()->toDateString(),
            'shipment_date' => now()->toDateString(),
            'btb_limit_pct' => 70,
        ];
    }
}
