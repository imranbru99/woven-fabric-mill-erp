<?php

declare(strict_types=1);

namespace App\Filament\Resources\PayrollLineResource\Pages;

use App\Filament\Resources\PayrollLineResource;
use Filament\Resources\Pages\EditRecord;

class EditPayrollLine extends EditRecord
{
    protected static string $resource = PayrollLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
