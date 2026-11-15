<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SizeRecipeItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SizeRecipeItem>
 */
class SizeRecipeItemFactory extends Factory
{
    protected $model = SizeRecipeItem::class;

    public function definition(): array
    {
        return [
            'qty_per_kg' => 0,
        ];
    }
}
