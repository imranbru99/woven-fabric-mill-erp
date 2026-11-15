<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Visitor>
 */
class VisitorFactory extends Factory
{
    protected $model = Visitor::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'company' => fake()->words(3, true),
            'purpose' => fake()->words(3, true),
            'badge_no' => fake()->words(3, true),
            'in_at' => now(),
            'out_at' => now(),
            'host' => fake()->words(3, true),
        ];
    }
}
