<?php

declare(strict_types=1);

namespace App\Filament\Resources\EtpLogResource\Pages;

use App\Filament\Resources\EtpLogResource;
use Filament\Resources\Pages\EditRecord;

class EditEtpLog extends EditRecord
{
    protected static string $resource = EtpLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
