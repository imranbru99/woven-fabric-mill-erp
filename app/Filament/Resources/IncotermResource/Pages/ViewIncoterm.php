<?php

declare(strict_types=1);

namespace App\Filament\Resources\IncotermResource\Pages;

use App\Filament\Resources\IncotermResource;
use Filament\Resources\Pages\ViewRecord;

class ViewIncoterm extends ViewRecord
{
    protected static string $resource = IncotermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
