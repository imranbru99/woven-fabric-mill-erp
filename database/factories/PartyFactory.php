<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Party;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Party>
 */
class PartyFactory extends Factory
{
    protected $model = Party::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'type' => 'buyer',
            'country' => 'BD',
            'currency_code' => 'BDT',
            'credit_limit' => 0,
            'payment_days' => 30,
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->words(3, true),
            'tax_id' => fake()->words(3, true),
            'address' => fake()->paragraph(),
            'is_active' => true,
        ];
    }
}
