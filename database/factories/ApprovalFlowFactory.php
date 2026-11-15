<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ApprovalFlow;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ApprovalFlow>
 */
class ApprovalFlowFactory extends Factory
{
    protected $model = ApprovalFlow::class;

    public function definition(): array
    {
        return [
            'document_type' => fake()->words(3, true),
            'name' => fake()->words(3, true),
            'is_active' => true,
        ];
    }
}
