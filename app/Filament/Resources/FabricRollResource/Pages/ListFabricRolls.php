<?php

declare(strict_types=1);

namespace App\Filament\Resources\FabricRollResource\Pages;

use App\Filament\Resources\FabricRollResource;
use Filament\Resources\Pages\ListRecords;

class ListFabricRolls extends ListRecords
{
    protected static string $resource = FabricRollResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
