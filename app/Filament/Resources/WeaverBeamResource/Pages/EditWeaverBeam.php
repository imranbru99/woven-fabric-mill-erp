<?php

declare(strict_types=1);

namespace App\Filament\Resources\WeaverBeamResource\Pages;

use App\Filament\Resources\WeaverBeamResource;
use Filament\Resources\Pages\EditRecord;

class EditWeaverBeam extends EditRecord
{
    protected static string $resource = WeaverBeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
