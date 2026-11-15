<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\RequestForQuotation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RequestForQuotation>
 */
class RequestForQuotationFactory extends Factory
{
    protected $model = RequestForQuotation::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'due_on' => now()->toDateString(),
        ];
    }
}
