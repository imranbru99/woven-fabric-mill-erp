<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierScorecardResource\Pages;

use App\Filament\Resources\SupplierScorecardResource;
use Filament\Resources\Pages\ListRecords;

class ListSupplierScorecards extends ListRecords
{
    protected static string $resource = SupplierScorecardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
