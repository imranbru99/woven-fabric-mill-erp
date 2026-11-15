<?php

declare(strict_types=1);

namespace App\Filament\Resources\StockLotResource\Pages;

use App\Filament\Resources\StockLotResource;
use Filament\Resources\Pages\ViewRecord;

class ViewStockLot extends ViewRecord
{
    protected static string $resource = StockLotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
