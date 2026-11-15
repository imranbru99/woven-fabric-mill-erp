<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BillOfEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BillOfEntry>
 */
class BillOfEntryFactory extends Factory
{
    protected $model = BillOfEntry::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'be_number' => fake()->words(3, true),
            'be_date' => now()->toDateString(),
            'assessable_value' => 0,
            'duty' => 0,
            'vat' => 0,
            'other_charges' => 0,
        ];
    }
}
