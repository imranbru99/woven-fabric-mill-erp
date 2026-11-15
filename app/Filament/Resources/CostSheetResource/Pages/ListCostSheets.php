<?php

declare(strict_types=1);

namespace App\Filament\Resources\CostSheetResource\Pages;

use App\Filament\Resources\CostSheetResource;
use Filament\Resources\Pages\ListRecords;

class ListCostSheets extends ListRecords
{
    protected static string $resource = CostSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
