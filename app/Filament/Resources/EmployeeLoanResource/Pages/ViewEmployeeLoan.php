<?php

declare(strict_types=1);

namespace App\Filament\Resources\EmployeeLoanResource\Pages;

use App\Filament\Resources\EmployeeLoanResource;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployeeLoan extends ViewRecord
{
    protected static string $resource = EmployeeLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
