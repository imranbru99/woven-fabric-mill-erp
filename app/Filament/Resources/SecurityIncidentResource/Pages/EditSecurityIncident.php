<?php

declare(strict_types=1);

namespace App\Filament\Resources\SecurityIncidentResource\Pages;

use App\Filament\Resources\SecurityIncidentResource;
use Filament\Resources\Pages\EditRecord;

class EditSecurityIncident extends EditRecord
{
    protected static string $resource = SecurityIncidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
