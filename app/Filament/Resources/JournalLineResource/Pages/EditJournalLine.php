<?php

declare(strict_types=1);

namespace App\Filament\Resources\JournalLineResource\Pages;

use App\Filament\Resources\JournalLineResource;
use Filament\Resources\Pages\EditRecord;

class EditJournalLine extends EditRecord
{
    protected static string $resource = JournalLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
