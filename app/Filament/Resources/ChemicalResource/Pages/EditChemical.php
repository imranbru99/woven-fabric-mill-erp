<?php

declare(strict_types=1);

namespace App\Filament\Resources\ChemicalResource\Pages;

use App\Filament\Resources\ChemicalResource;
use Filament\Resources\Pages\EditRecord;

class EditChemical extends EditRecord
{
    protected static string $resource = ChemicalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
