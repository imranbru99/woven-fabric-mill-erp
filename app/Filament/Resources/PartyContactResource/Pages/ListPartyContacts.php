<?php

declare(strict_types=1);

namespace App\Filament\Resources\PartyContactResource\Pages;

use App\Filament\Resources\PartyContactResource;
use Filament\Resources\Pages\ListRecords;

class ListPartyContacts extends ListRecords
{
    protected static string $resource = PartyContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
