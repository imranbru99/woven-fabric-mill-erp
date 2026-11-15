<?php

declare(strict_types=1);

namespace App\Filament\Resources\StockBalanceResource\Pages;

use App\Filament\Resources\StockBalanceResource;
use Filament\Resources\Pages\EditRecord;

class EditStockBalance extends EditRecord
{
    protected static string $resource = StockBalanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
