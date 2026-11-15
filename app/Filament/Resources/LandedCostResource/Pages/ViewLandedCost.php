<?php

declare(strict_types=1);

namespace App\Filament\Resources\LandedCostResource\Pages;

use App\Filament\Resources\LandedCostResource;
use Filament\Resources\Pages\ViewRecord;

class ViewLandedCost extends ViewRecord
{
    protected static string $resource = LandedCostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
