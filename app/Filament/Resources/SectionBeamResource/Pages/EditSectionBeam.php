<?php

declare(strict_types=1);

namespace App\Filament\Resources\SectionBeamResource\Pages;

use App\Filament\Resources\SectionBeamResource;
use Filament\Resources\Pages\EditRecord;

class EditSectionBeam extends EditRecord
{
    protected static string $resource = SectionBeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
