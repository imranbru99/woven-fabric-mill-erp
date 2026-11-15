<?php

declare(strict_types=1);

namespace App\Filament\Resources\SecurityIncidentResource\Pages;

use App\Filament\Resources\SecurityIncidentResource;
use Filament\Resources\Pages\ListRecords;

class ListSecurityIncidents extends ListRecords
{
    protected static string $resource = SecurityIncidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
