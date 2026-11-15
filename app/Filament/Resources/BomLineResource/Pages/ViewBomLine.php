<?php

declare(strict_types=1);

namespace App\Filament\Resources\BomLineResource\Pages;

use App\Filament\Resources\BomLineResource;
use Filament\Resources\Pages\ViewRecord;

class ViewBomLine extends ViewRecord
{
    protected static string $resource = BomLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
