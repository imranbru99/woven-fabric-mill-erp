<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SupplierClaim;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SupplierClaim>
 */
class SupplierClaimFactory extends Factory
{
    protected $model = SupplierClaim::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'reason' => fake()->words(3, true),
            'claimed_qty' => 0,
            'amount' => 0,
            'recovered' => 0,
        ];
    }
}
