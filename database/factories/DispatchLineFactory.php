<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\DispatchLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<DispatchLine>
 */
class DispatchLineFactory extends Factory
{
    protected $model = DispatchLine::class;

    public function definition(): array
    {
        return [
            'metres' => 0,
        ];
    }
}
