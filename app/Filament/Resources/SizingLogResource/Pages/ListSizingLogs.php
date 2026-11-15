<?php

declare(strict_types=1);

namespace App\Filament\Resources\SizingLogResource\Pages;

use App\Filament\Resources\SizingLogResource;
use Filament\Resources\Pages\ListRecords;

class ListSizingLogs extends ListRecords
{
    protected static string $resource = SizingLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
