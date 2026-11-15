<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Certificate>
 */
class CertificateFactory extends Factory
{
    protected $model = Certificate::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'issuer' => fake()->words(3, true),
            'issued_on' => now()->toDateString(),
            'expires_on' => now()->toDateString(),
            'file_path' => fake()->words(3, true),
            'is_public' => true,
        ];
    }
}
