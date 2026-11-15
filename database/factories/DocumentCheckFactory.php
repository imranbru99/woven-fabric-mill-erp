<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\DocumentCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DocumentCheck>
 */
class DocumentCheckFactory extends Factory
{
    protected $model = DocumentCheck::class;

    public function definition(): array
    {
        return [
            'document_name' => fake()->words(3, true),
            'is_present' => false,
            'matches_lc' => false,
            'discrepancy' => fake()->paragraph(),
        ];
    }
}
