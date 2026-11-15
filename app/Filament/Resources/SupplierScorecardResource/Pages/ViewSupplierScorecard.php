<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierScorecardResource\Pages;

use App\Filament\Resources\SupplierScorecardResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSupplierScorecard extends ViewRecord
{
    protected static string $resource = SupplierScorecardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
