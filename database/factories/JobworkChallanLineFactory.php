<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\JobworkChallanLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<JobworkChallanLine>
 */
class JobworkChallanLineFactory extends Factory
{
    protected $model = JobworkChallanLine::class;

    public function definition(): array
    {
        return [
            'metres' => 0,
        ];
    }
}
