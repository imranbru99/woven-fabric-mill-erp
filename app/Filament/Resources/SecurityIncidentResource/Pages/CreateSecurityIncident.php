<?php

declare(strict_types=1);

namespace App\Filament\Resources\SecurityIncidentResource\Pages;

use App\Filament\Resources\SecurityIncidentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSecurityIncident extends CreateRecord
{
    protected static string $resource = SecurityIncidentResource::class;

}
