<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Branch>
 */
class BranchFactory extends Factory
{
    protected $model = Branch::class;

    public function definition(): array
    {
        return [
            'company_id' => \App\Models\Company::factory(),
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'address' => fake()->words(3, true),
            'finishing_enabled' => true,
            'is_active' => true,
        ];
    }
}
