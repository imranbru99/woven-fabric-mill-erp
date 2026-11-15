<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'locale' => 'en',
            'excerpt' => fake()->paragraph(),
            'body' => fake()->paragraph(),
            'published_at' => now(),
            'is_published' => false,
        ];
    }
}
