<?php

declare(strict_types=1);

namespace App\Filament\Resources\ReedResource\Pages;

use App\Filament\Resources\ReedResource;
use Filament\Resources\Pages\EditRecord;

class EditReed extends EditRecord
{
    protected static string $resource = ReedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
