<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\StockMoveResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\StockMove;

class StockMoveResource extends MillResource
{
    protected static ?string $model = StockMove::class;

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Stock Moves';

    protected static ?int $navigationSort = 81;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockMoves::route('/'),
            'create' => Pages\CreateStockMove::route('/create'),
            'view' => Pages\ViewStockMove::route('/{record}'),
            'edit' => Pages\EditStockMove::route('/{record}/edit'),
        ];
    }
}
