<?php

declare(strict_types=1);

namespace App\Filament\Resources\CostSheetLineResource\Pages;

use App\Filament\Resources\CostSheetLineResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCostSheetLine extends ViewRecord
{
    protected static string $resource = CostSheetLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
