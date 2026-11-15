<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\IssueRule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<IssueRule>
 */
class IssueRuleFactory extends Factory
{
    protected $model = IssueRule::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'module' => fake()->words(3, true),
            'severity' => 'medium',
            'enabled' => true,
            'threshold' => [],
            'assign_role' => fake()->words(3, true),
            'description' => fake()->paragraph(),
        ];
    }
}
