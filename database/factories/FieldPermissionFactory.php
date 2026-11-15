<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FieldPermission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FieldPermission>
 */
class FieldPermissionFactory extends Factory
{
    protected $model = FieldPermission::class;

    public function definition(): array
    {
        return [
            'role_id' => \App\Models\Role::factory(),
            'resource' => fake()->words(3, true),
            'field' => fake()->words(3, true),
            'can_view' => false,
            'can_edit' => false,
        ];
    }
}
