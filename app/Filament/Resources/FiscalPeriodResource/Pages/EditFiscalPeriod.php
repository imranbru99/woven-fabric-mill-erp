<?php

declare(strict_types=1);

namespace App\Filament\Resources\FiscalPeriodResource\Pages;

use App\Filament\Resources\FiscalPeriodResource;
use Filament\Resources\Pages\EditRecord;

class EditFiscalPeriod extends EditRecord
{
    protected static string $resource = FiscalPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
