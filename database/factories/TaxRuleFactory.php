<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TaxRule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TaxRule>
 */
class TaxRuleFactory extends Factory
{
    protected $model = TaxRule::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'country' => 'BD',
            'kind' => 'vat',
            'rate_pct' => 0,
            'form_code' => fake()->words(3, true),
        ];
    }
}
