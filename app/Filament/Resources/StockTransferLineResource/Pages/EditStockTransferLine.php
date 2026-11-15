<?php

declare(strict_types=1);

namespace App\Filament\Resources\StockTransferLineResource\Pages;

use App\Filament\Resources\StockTransferLineResource;
use Filament\Resources\Pages\EditRecord;

class EditStockTransferLine extends EditRecord
{
    protected static string $resource = StockTransferLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
