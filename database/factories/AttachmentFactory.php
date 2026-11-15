<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attachment>
 */
class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    public function definition(): array
    {
        return [
            'attachable_type' => fake()->words(3, true),
            'attachable_id' => 1,
            'disk' => 'public',
            'path' => fake()->words(3, true),
            'name' => fake()->words(3, true),
            'mime' => fake()->words(3, true),
            'size' => 0,
        ];
    }
}
