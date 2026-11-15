<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BuyerClaim;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BuyerClaim>
 */
class BuyerClaimFactory extends Factory
{
    protected $model = BuyerClaim::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'reason' => fake()->words(3, true),
            'claimed_m' => 0,
            'amount' => 0,
            'root_cause' => fake()->paragraph(),
        ];
    }
}
