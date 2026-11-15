<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'legal_name' => fake()->words(3, true),
            'country' => 'BD',
            'currency_code' => 'BDT',
            'timezone' => 'Asia/Dhaka',
            'tax_id' => fake()->words(3, true),
            'bin_vat' => fake()->words(3, true),
            'address' => fake()->words(3, true),
            'phone' => fake()->words(3, true),
            'email' => fake()->unique()->safeEmail(),
            'about' => fake()->paragraph(),
        ];
    }
}
