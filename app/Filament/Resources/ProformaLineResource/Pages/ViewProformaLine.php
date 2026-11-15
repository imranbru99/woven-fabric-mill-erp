<?php

declare(strict_types=1);

namespace App\Filament\Resources\ProformaLineResource\Pages;

use App\Filament\Resources\ProformaLineResource;
use Filament\Resources\Pages\ViewRecord;

class ViewProformaLine extends ViewRecord
{
    protected static string $resource = ProformaLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
