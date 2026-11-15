<?php

declare(strict_types=1);

namespace App\Filament\Resources\EtpLogResource\Pages;

use App\Filament\Resources\EtpLogResource;
use Filament\Resources\Pages\ListRecords;

class ListEtpLogs extends ListRecords
{
    protected static string $resource = EtpLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
