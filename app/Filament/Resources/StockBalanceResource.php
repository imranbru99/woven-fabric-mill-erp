<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\StockBalanceResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\StockBalance;

class StockBalanceResource extends MillResource
{
    protected static ?string $model = StockBalance::class;

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Stock Balances';

    protected static ?int $navigationSort = 82;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockBalances::route('/'),
            'create' => Pages\CreateStockBalance::route('/create'),
            'view' => Pages\ViewStockBalance::route('/{record}'),
            'edit' => Pages\EditStockBalance::route('/{record}/edit'),
        ];
    }
}
