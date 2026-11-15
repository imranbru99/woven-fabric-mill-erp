<?php

declare(strict_types=1);

namespace App\Filament\Resources\SectionBeamResource\Pages;

use App\Filament\Resources\SectionBeamResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSectionBeam extends ViewRecord
{
    protected static string $resource = SectionBeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
