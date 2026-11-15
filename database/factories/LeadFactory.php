<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'company_name' => fake()->words(3, true),
            'contact_name' => fake()->words(3, true),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->words(3, true),
            'source' => 'website',
            'country' => 'BD',
        ];
    }
}
