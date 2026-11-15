<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProformaInvoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProformaInvoice>
 */
class ProformaInvoiceFactory extends Factory
{
    protected $model = ProformaInvoice::class;

    public function definition(): array
    {
        return [
            'number' => fake()->unique()->bothify('??-#####'),
            'status' => 'draft',
            'version' => 1,
            'approved_at' => now(),
            'pi_date' => now()->toDateString(),
            'total' => 0,
        ];
    }
}
