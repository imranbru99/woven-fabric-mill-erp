<?php

declare(strict_types=1);

namespace App\Filament\Resources\RollDefectResource\Pages;

use App\Filament\Resources\RollDefectResource;
use Filament\Resources\Pages\EditRecord;

class EditRollDefect extends EditRecord
{
    protected static string $resource = RollDefectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
