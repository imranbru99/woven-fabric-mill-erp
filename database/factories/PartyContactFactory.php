<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PartyContact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PartyContact>
 */
class PartyContactFactory extends Factory
{
    protected $model = PartyContact::class;

    public function definition(): array
    {
        return [
            'party_id' => \App\Models\Party::factory(),
            'name' => fake()->words(3, true),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->words(3, true),
            'role_title' => fake()->words(3, true),
        ];
    }
}
