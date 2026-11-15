<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ApprovalLimit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ApprovalLimit>
 */
class ApprovalLimitFactory extends Factory
{
    protected $model = ApprovalLimit::class;

    public function definition(): array
    {
        return [
            'role_id' => \App\Models\Role::factory(),
            'document_type' => fake()->words(3, true),
            'max_amount' => 0,
        ];
    }
}
