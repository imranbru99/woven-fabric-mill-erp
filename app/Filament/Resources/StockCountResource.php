<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\StockCountResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\StockCount;

class StockCountResource extends MillResource
{
    protected static ?string $model = StockCount::class;

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Stock Counts';

    protected static ?int $navigationSort = 83;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockCounts::route('/'),
            'create' => Pages\CreateStockCount::route('/create'),
            'view' => Pages\ViewStockCount::route('/{record}'),
            'edit' => Pages\EditStockCount::route('/{record}/edit'),
        ];
    }
}
