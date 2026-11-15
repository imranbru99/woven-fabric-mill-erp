<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SecurityIncidentResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SecurityIncident;

class SecurityIncidentResource extends MillResource
{
    protected static ?string $model = SecurityIncident::class;

    protected static ?string $navigationGroup = 'Dispatch & Gate';

    protected static ?string $navigationLabel = 'Security Incidents';

    protected static ?int $navigationSort = 137;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSecurityIncidents::route('/'),
            'create' => Pages\CreateSecurityIncident::route('/create'),
            'view' => Pages\ViewSecurityIncident::route('/{record}'),
            'edit' => Pages\EditSecurityIncident::route('/{record}/edit'),
        ];
    }
}
