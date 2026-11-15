<?php

declare(strict_types=1);

namespace App\Filament\Resources\JournalLineResource\Pages;

use App\Filament\Resources\JournalLineResource;
use Filament\Resources\Pages\ListRecords;

class ListJournalLines extends ListRecords
{
    protected static string $resource = JournalLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
