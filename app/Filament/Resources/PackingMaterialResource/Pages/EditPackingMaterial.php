<?php

declare(strict_types=1);

namespace App\Filament\Resources\PackingMaterialResource\Pages;

use App\Filament\Resources\PackingMaterialResource;
use Filament\Resources\Pages\EditRecord;

class EditPackingMaterial extends EditRecord
{
    protected static string $resource = PackingMaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
