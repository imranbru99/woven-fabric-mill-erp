<?php

declare(strict_types=1);

namespace App\Filament\Resources\StockCountLineResource\Pages;

use App\Filament\Resources\StockCountLineResource;
use Filament\Resources\Pages\EditRecord;

class EditStockCountLine extends EditRecord
{
    protected static string $resource = StockCountLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
