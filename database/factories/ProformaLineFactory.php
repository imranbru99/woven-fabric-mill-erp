<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProformaLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProformaLine>
 */
class ProformaLineFactory extends Factory
{
    protected $model = ProformaLine::class;

    public function definition(): array
    {
        return [
            'quantity' => 0,
            'uom' => 'm',
            'rate' => 0,
            'amount' => 0,
        ];
    }
}
