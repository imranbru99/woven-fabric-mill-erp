<?php

declare(strict_types=1);

namespace App\Filament\Resources\StockMoveResource\Pages;

use App\Filament\Resources\StockMoveResource;
use Filament\Resources\Pages\ListRecords;

class ListStockMoves extends ListRecords
{
    protected static string $resource = StockMoveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
