<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ApprovalStep;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ApprovalStep>
 */
class ApprovalStepFactory extends Factory
{
    protected $model = ApprovalStep::class;

    public function definition(): array
    {
        return [
            'approval_flow_id' => \App\Models\ApprovalFlow::factory(),
            'step_no' => 1,
            'role_slug' => fake()->words(3, true),
            'min_amount' => 0,
        ];
    }
}
