<?php

declare(strict_types=1);

namespace App\Filament\Resources\StockLotResource\Pages;

use App\Filament\Resources\StockLotResource;
use Filament\Resources\Pages\EditRecord;

class EditStockLot extends EditRecord
{
    protected static string $resource = StockLotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
