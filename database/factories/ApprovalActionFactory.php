<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ApprovalAction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ApprovalAction>
 */
class ApprovalActionFactory extends Factory
{
    protected $model = ApprovalAction::class;

    public function definition(): array
    {
        return [
            'approval_request_id' => \App\Models\ApprovalRequest::factory(),
            'action' => 'submitted',
            'comment' => fake()->paragraph(),
        ];
    }
}
