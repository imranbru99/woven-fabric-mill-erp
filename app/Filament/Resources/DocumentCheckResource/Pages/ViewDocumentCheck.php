<?php

declare(strict_types=1);

namespace App\Filament\Resources\DocumentCheckResource\Pages;

use App\Filament\Resources\DocumentCheckResource;
use Filament\Resources\Pages\ViewRecord;

class ViewDocumentCheck extends ViewRecord
{
    protected static string $resource = DocumentCheckResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
