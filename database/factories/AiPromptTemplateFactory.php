<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\AiPromptTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AiPromptTemplate>
 */
class AiPromptTemplateFactory extends Factory
{
    protected $model = AiPromptTemplate::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'prompt' => fake()->paragraph(),
            'enabled' => true,
        ];
    }
}
