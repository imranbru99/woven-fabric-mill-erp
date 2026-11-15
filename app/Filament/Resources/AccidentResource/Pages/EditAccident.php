<?php

declare(strict_types=1);

namespace App\Filament\Resources\AccidentResource\Pages;

use App\Filament\Resources\AccidentResource;
use Filament\Resources\Pages\EditRecord;

class EditAccident extends EditRecord
{
    protected static string $resource = AccidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
