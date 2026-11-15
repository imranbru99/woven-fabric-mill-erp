<?php

declare(strict_types=1);

namespace App\Filament\Resources\StockTransferLineResource\Pages;

use App\Filament\Resources\StockTransferLineResource;
use Filament\Resources\Pages\ViewRecord;

class ViewStockTransferLine extends ViewRecord
{
    protected static string $resource = StockTransferLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
