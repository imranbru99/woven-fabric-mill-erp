<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\JournalLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JournalLine>
 */
class JournalLineFactory extends Factory
{
    protected $model = JournalLine::class;

    public function definition(): array
    {
        return [
            'debit' => 0,
            'credit' => 0,
            'narration' => fake()->words(3, true),
            'currency_code' => 'BDT',
            'fx_rate' => 1,
        ];
    }
}
