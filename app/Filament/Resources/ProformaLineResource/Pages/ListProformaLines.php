<?php

declare(strict_types=1);

namespace App\Filament\Resources\ProformaLineResource\Pages;

use App\Filament\Resources\ProformaLineResource;
use Filament\Resources\Pages\ListRecords;

class ListProformaLines extends ListRecords
{
    protected static string $resource = ProformaLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
