<?php

declare(strict_types=1);

namespace App\Filament\Resources\FiscalPeriodResource\Pages;

use App\Filament\Resources\FiscalPeriodResource;
use Filament\Resources\Pages\ViewRecord;

class ViewFiscalPeriod extends ViewRecord
{
    protected static string $resource = FiscalPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
