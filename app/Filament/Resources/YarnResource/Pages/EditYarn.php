<?php

declare(strict_types=1);

namespace App\Filament\Resources\YarnResource\Pages;

use App\Filament\Resources\YarnResource;
use Filament\Resources\Pages\EditRecord;

class EditYarn extends EditRecord
{
    protected static string $resource = YarnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
