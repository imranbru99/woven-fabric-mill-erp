<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\StockCountLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\StockCountLine;

class StockCountLineResource extends MillResource
{
    protected static ?string $model = StockCountLine::class;

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Stock Count Lines';

    protected static ?int $navigationSort = 84;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockCountLines::route('/'),
            'create' => Pages\CreateStockCountLine::route('/create'),
            'view' => Pages\ViewStockCountLine::route('/{record}'),
            'edit' => Pages\EditStockCountLine::route('/{record}/edit'),
        ];
    }
}
