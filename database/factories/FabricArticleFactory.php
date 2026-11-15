<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FabricArticle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FabricArticle>
 */
class FabricArticleFactory extends Factory
{
    protected $model = FabricArticle::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('??-#####'),
            'name' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'epi' => 0,
            'ppi' => 0,
            'weave' => 'plain',
            'grey_width_cm' => 0,
            'finished_width_cm' => 0,
            'grey_gsm' => 0,
            'finished_gsm' => 0,
            'warp_shrinkage_pct' => 0,
            'weft_shrinkage_pct' => 0,
            'composition' => fake()->words(3, true),
            'finish_type' => fake()->words(3, true),
            'end_use' => fake()->words(3, true),
            'reed_count' => 0,
            'reed_space_inch' => 0,
            'ends_per_dent' => 2,
            'selvedge_ends' => 0,
            'selvedge_type' => fake()->words(3, true),
            'crimp_warp_pct' => 8,
            'crimp_weft_pct' => 6,
            'design_grid' => [],
            'total_ends' => 0,
            'warp_kg_per_100m' => 0,
            'weft_kg_per_100m' => 0,
            'calculated_gsm' => 0,
            'expected_efficiency' => 85,
            'metres_per_loom_shift' => 0,
            'is_public' => false,
            'public_summary' => fake()->paragraph(),
            'image_path' => fake()->words(3, true),
        ];
    }
}
