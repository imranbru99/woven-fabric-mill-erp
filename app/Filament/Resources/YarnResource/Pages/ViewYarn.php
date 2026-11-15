<?php

declare(strict_types=1);

namespace App\Filament\Resources\YarnResource\Pages;

use App\Filament\Resources\YarnResource;
use Filament\Resources\Pages\ViewRecord;

class ViewYarn extends ViewRecord
{
    protected static string $resource = YarnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
