<?php

declare(strict_types=1);

namespace App\Filament\Resources\GatePassLineResource\Pages;

use App\Filament\Resources\GatePassLineResource;
use Filament\Resources\Pages\ViewRecord;

class ViewGatePassLine extends ViewRecord
{
    protected static string $resource = GatePassLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
