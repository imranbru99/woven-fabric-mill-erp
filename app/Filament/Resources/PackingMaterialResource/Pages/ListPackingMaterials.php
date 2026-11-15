<?php

declare(strict_types=1);

namespace App\Filament\Resources\PackingMaterialResource\Pages;

use App\Filament\Resources\PackingMaterialResource;
use Filament\Resources\Pages\ListRecords;

class ListPackingMaterials extends ListRecords
{
    protected static string $resource = PackingMaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
