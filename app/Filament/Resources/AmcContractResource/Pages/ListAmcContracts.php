<?php

declare(strict_types=1);

namespace App\Filament\Resources\AmcContractResource\Pages;

use App\Filament\Resources\AmcContractResource;
use Filament\Resources\Pages\ListRecords;

class ListAmcContracts extends ListRecords
{
    protected static string $resource = AmcContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
