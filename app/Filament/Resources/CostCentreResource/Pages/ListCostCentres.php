<?php

declare(strict_types=1);

namespace App\Filament\Resources\CostCentreResource\Pages;

use App\Filament\Resources\CostCentreResource;
use Filament\Resources\Pages\ListRecords;

class ListCostCentres extends ListRecords
{
    protected static string $resource = CostCentreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
