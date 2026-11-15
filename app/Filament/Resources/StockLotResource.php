<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\StockLotResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\StockLot;

class StockLotResource extends MillResource
{
    protected static ?string $model = StockLot::class;

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Stock Lots';

    protected static ?int $navigationSort = 80;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockLots::route('/'),
            'create' => Pages\CreateStockLot::route('/create'),
            'view' => Pages\ViewStockLot::route('/{record}'),
            'edit' => Pages\EditStockLot::route('/{record}/edit'),
        ];
    }
}
