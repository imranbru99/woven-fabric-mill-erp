<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\GalleryItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GalleryItem>
 */
class GalleryItemFactory extends Factory
{
    protected $model = GalleryItem::class;

    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'section' => 'facilities',
            'image_path' => fake()->words(3, true),
            'caption' => fake()->paragraph(),
            'sort_order' => 0,
            'is_public' => true,
        ];
    }
}
