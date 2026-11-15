<?php

declare(strict_types=1);

namespace App\Filament\Resources\WeaverBeamResource\Pages;

use App\Filament\Resources\WeaverBeamResource;
use Filament\Resources\Pages\ViewRecord;

class ViewWeaverBeam extends ViewRecord
{
    protected static string $resource = WeaverBeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
