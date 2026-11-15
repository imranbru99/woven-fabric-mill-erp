<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ApprovalRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ApprovalRequest>
 */
class ApprovalRequestFactory extends Factory
{
    protected $model = ApprovalRequest::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'document_type' => fake()->words(3, true),
            'document_id' => 1,
            'current_step' => 1,
            'amount' => 0,
        ];
    }
}
