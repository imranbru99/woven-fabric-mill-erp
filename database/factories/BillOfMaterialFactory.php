<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BillOfMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BillOfMaterial>
 */
class BillOfMaterialFactory extends Factory
{
    protected $model = BillOfMaterial::class;

    public function definition(): array
    {
        return [
            'warp_kg_per_100m' => 0,
            'weft_kg_per_100m' => 0,
            'size_addon_pct' => 10,
            'waste_warping_pct' => 1,
            'waste_sizing_pct' => 0.5,
            'waste_drawing_pct' => 0.2,
            'waste_weaving_pct' => 2,
            'waste_inspection_pct' => 1,
            'is_active' => true,
        ];
    }
}
