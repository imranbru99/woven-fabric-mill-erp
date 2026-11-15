<?php

declare(strict_types=1);

namespace App\Filament\Resources\LoomProductionResource\Pages;

use App\Filament\Resources\LoomProductionResource;
use Filament\Resources\Pages\ViewRecord;

class ViewLoomProduction extends ViewRecord
{
    protected static string $resource = LoomProductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
