<?php

declare(strict_types=1);

namespace App\Filament\Resources\ChemicalResource\Pages;

use App\Filament\Resources\ChemicalResource;
use Filament\Resources\Pages\ViewRecord;

class ViewChemical extends ViewRecord
{
    protected static string $resource = ChemicalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
