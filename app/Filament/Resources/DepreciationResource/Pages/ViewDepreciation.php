<?php

declare(strict_types=1);

namespace App\Filament\Resources\DepreciationResource\Pages;

use App\Filament\Resources\DepreciationResource;
use Filament\Resources\Pages\ViewRecord;

class ViewDepreciation extends ViewRecord
{
    protected static string $resource = DepreciationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
