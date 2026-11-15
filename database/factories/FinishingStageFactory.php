<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FinishingStage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FinishingStage>
 */
class FinishingStageFactory extends Factory
{
    protected $model = FinishingStage::class;

    public function definition(): array
    {
        return [
            'stage' => 'singeing',
            'parameters' => [],
            'result' => 'pending',
            'started_at' => now(),
            'finished_at' => now(),
        ];
    }
}
