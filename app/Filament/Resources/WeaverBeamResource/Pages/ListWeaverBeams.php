<?php

declare(strict_types=1);

namespace App\Filament\Resources\WeaverBeamResource\Pages;

use App\Filament\Resources\WeaverBeamResource;
use Filament\Resources\Pages\ListRecords;

class ListWeaverBeams extends ListRecords
{
    protected static string $resource = WeaverBeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
