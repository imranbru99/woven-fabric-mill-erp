<?php

declare(strict_types=1);

namespace App\Filament\Resources\FabricRollResource\Pages;

use App\Filament\Resources\FabricRollResource;
use Filament\Resources\Pages\EditRecord;

class EditFabricRoll extends EditRecord
{
    protected static string $resource = FabricRollResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
