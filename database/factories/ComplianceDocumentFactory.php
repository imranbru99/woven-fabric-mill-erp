<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ComplianceDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ComplianceDocument>
 */
class ComplianceDocumentFactory extends Factory
{
    protected $model = ComplianceDocument::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'category' => 'licence',
            'issued_on' => now()->toDateString(),
            'expires_on' => now()->toDateString(),
            'file_path' => fake()->words(3, true),
        ];
    }
}
