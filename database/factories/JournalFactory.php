<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Journal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Journal>
 */
class JournalFactory extends Factory
{
    protected $model = Journal::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'journal_date' => now()->toDateString(),
            'source_type' => fake()->words(3, true),
            'source_id' => 1,
            'purpose' => 'manual',
            'narration' => fake()->words(3, true),
            'status' => 'posted',
            'currency_code' => 'BDT',
            'total_debit' => 0,
            'total_credit' => 0,
        ];
    }
}
