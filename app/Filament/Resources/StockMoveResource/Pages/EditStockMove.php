<?php

declare(strict_types=1);

namespace App\Filament\Resources\StockMoveResource\Pages;

use App\Filament\Resources\StockMoveResource;
use Filament\Resources\Pages\EditRecord;

class EditStockMove extends EditRecord
{
    protected static string $resource = StockMoveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
