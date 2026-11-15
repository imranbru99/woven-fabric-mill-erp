<?php

declare(strict_types=1);

namespace App\Filament\Resources\WageRateResource\Pages;

use App\Filament\Resources\WageRateResource;
use Filament\Resources\Pages\ViewRecord;

class ViewWageRate extends ViewRecord
{
    protected static string $resource = WageRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
