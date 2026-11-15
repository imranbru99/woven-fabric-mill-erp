<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PackingList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PackingList>
 */
class PackingListFactory extends Factory
{
    protected $model = PackingList::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'cartons' => 0,
            'gross_kg' => 0,
            'net_kg' => 0,
            'total_metres' => 0,
        ];
    }
}
