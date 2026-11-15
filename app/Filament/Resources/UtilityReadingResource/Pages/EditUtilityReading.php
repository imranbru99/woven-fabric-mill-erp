<?php

declare(strict_types=1);

namespace App\Filament\Resources\UtilityReadingResource\Pages;

use App\Filament\Resources\UtilityReadingResource;
use Filament\Resources\Pages\EditRecord;

class EditUtilityReading extends EditRecord
{
    protected static string $resource = UtilityReadingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
