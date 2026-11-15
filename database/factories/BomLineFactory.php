<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BomLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BomLine>
 */
class BomLineFactory extends Factory
{
    protected $model = BomLine::class;

    public function definition(): array
    {
        return [
            'stage' => 'weaving',
            'item_type' => 'yarn',
            'item_id' => 1,
            'qty_per_100m' => 0,
            'uom' => 'kg',
        ];
    }
}
