<?php

declare(strict_types=1);

namespace App\Filament\Resources\SizingLogResource\Pages;

use App\Filament\Resources\SizingLogResource;
use Filament\Resources\Pages\EditRecord;

class EditSizingLog extends EditRecord
{
    protected static string $resource = SizingLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
