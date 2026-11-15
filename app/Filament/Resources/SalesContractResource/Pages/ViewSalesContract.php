<?php

declare(strict_types=1);

namespace App\Filament\Resources\SalesContractResource\Pages;

use App\Filament\Resources\SalesContractResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSalesContract extends ViewRecord
{
    protected static string $resource = SalesContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
