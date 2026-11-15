<?php

declare(strict_types=1);

namespace App\Filament\Resources\PayrollLineResource\Pages;

use App\Filament\Resources\PayrollLineResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePayrollLine extends CreateRecord
{
    protected static string $resource = PayrollLineResource::class;

}
