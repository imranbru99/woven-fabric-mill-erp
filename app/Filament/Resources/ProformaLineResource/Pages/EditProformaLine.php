<?php

declare(strict_types=1);

namespace App\Filament\Resources\ProformaLineResource\Pages;

use App\Filament\Resources\ProformaLineResource;
use Filament\Resources\Pages\EditRecord;

class EditProformaLine extends EditRecord
{
    protected static string $resource = ProformaLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
