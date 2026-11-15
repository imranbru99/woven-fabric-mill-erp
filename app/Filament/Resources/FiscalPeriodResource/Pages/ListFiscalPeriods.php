<?php

declare(strict_types=1);

namespace App\Filament\Resources\FiscalPeriodResource\Pages;

use App\Filament\Resources\FiscalPeriodResource;
use Filament\Resources\Pages\ListRecords;

class ListFiscalPeriods extends ListRecords
{
    protected static string $resource = FiscalPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
