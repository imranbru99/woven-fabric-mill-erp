<?php

declare(strict_types=1);

namespace App\Filament\Resources\EtpLogResource\Pages;

use App\Filament\Resources\EtpLogResource;
use Filament\Resources\Pages\ViewRecord;

class ViewEtpLog extends ViewRecord
{
    protected static string $resource = EtpLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
