<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\EtpLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EtpLog>
 */
class EtpLogFactory extends Factory
{
    protected $model = EtpLog::class;

    public function definition(): array
    {
        return [
            'logged_at' => now(),
            'inlet_ph' => 0,
            'outlet_ph' => 0,
            'inlet_bod' => 0,
            'outlet_bod' => 0,
            'sludge_kg' => 0,
            'within_limit' => true,
        ];
    }
}
