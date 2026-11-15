<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Issue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Issue>
 */
class IssueFactory extends Factory
{
    protected $model = Issue::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'issue_type' => 'production',
            'severity' => 'medium',
            'source' => 'manual',
            'rule_code' => fake()->words(3, true),
            'related_type' => fake()->words(3, true),
            'related_id' => 1,
            'escalation_level' => 0,
            'status' => 'open',
            'sla_due_at' => now(),
            'root_cause' => fake()->paragraph(),
            'five_why' => [],
            'corrective_action' => fake()->paragraph(),
            'preventive_action' => fake()->paragraph(),
            'cost_impact' => 0,
        ];
    }
}
