<?php

declare(strict_types=1);

namespace App\Filament\Resources\WageRateResource\Pages;

use App\Filament\Resources\WageRateResource;
use Filament\Resources\Pages\ListRecords;

class ListWageRates extends ListRecords
{
    protected static string $resource = WageRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
