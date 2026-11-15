<?php

declare(strict_types=1);

namespace App\Filament\Resources\DocumentCheckResource\Pages;

use App\Filament\Resources\DocumentCheckResource;
use Filament\Resources\Pages\ListRecords;

class ListDocumentChecks extends ListRecords
{
    protected static string $resource = DocumentCheckResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
