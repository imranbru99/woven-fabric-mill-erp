<?php

declare(strict_types=1);

namespace App\Filament\Resources\SizingLogResource\Pages;

use App\Filament\Resources\SizingLogResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSizingLog extends ViewRecord
{
    protected static string $resource = SizingLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
