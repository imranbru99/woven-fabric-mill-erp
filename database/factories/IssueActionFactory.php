<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\IssueAction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<IssueAction>
 */
class IssueActionFactory extends Factory
{
    protected $model = IssueAction::class;

    public function definition(): array
    {
        return [
            'action' => fake()->words(3, true),
            'acted_at' => now(),
        ];
    }
}
