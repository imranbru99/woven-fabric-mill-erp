<?php

declare(strict_types=1);

namespace App\Filament\Resources\UtilityReadingResource\Pages;

use App\Filament\Resources\UtilityReadingResource;
use Filament\Resources\Pages\ListRecords;

class ListUtilityReadings extends ListRecords
{
    protected static string $resource = UtilityReadingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
