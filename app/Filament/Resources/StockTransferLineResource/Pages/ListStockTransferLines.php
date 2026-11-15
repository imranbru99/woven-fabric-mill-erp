<?php

declare(strict_types=1);

namespace App\Filament\Resources\StockTransferLineResource\Pages;

use App\Filament\Resources\StockTransferLineResource;
use Filament\Resources\Pages\ListRecords;

class ListStockTransferLines extends ListRecords
{
    protected static string $resource = StockTransferLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
