<?php

declare(strict_types=1);

namespace App\Filament\Resources\SecurityRoundResource\Pages;

use App\Filament\Resources\SecurityRoundResource;
use Filament\Resources\Pages\ListRecords;

class ListSecurityRounds extends ListRecords
{
    protected static string $resource = SecurityRoundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
