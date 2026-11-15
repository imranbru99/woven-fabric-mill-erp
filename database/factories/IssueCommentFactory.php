<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\IssueComment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<IssueComment>
 */
class IssueCommentFactory extends Factory
{
    protected $model = IssueComment::class;

    public function definition(): array
    {
        return [
            'body' => fake()->paragraph(),
        ];
    }
}
