<?php

declare(strict_types=1);

namespace App\Filament\Resources\LoomProductionResource\Pages;

use App\Filament\Resources\LoomProductionResource;
use Filament\Resources\Pages\ListRecords;

class ListLoomProductions extends ListRecords
{
    protected static string $resource = LoomProductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
