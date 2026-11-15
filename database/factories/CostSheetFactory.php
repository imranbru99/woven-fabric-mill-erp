<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CostSheet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CostSheet>
 */
class CostSheetFactory extends Factory
{
    protected $model = CostSheet::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'currency_code' => 'BDT',
            'yarn_cost_per_m' => 0,
            'sizing_cost_per_m' => 0,
            'weaving_cost_per_m' => 0,
            'process_cost_per_m' => 0,
            'overhead_per_m' => 0,
            'finance_cost_per_m' => 0,
            'commission_per_m' => 0,
            'target_margin_pct' => 12,
            'quoted_rate' => 0,
            'valid_until' => now()->toDateString(),
            'sensitivity' => [],
        ];
    }
}
