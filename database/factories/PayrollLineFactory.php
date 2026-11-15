<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PayrollLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PayrollLine>
 */
class PayrollLineFactory extends Factory
{
    protected $model = PayrollLine::class;

    public function definition(): array
    {
        return [
            'basic' => 0,
            'piece' => 0,
            'overtime' => 0,
            'bonus' => 0,
            'advance' => 0,
            'deduction' => 0,
            'tax' => 0,
            'net' => 0,
            'metres' => 0,
            'picks' => 0,
        ];
    }
}
