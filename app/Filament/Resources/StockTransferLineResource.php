<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\StockTransferLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\StockTransferLine;

class StockTransferLineResource extends MillResource
{
    protected static ?string $model = StockTransferLine::class;

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Stock Transfer Lines';

    protected static ?int $navigationSort = 86;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockTransferLines::route('/'),
            'create' => Pages\CreateStockTransferLine::route('/create'),
            'view' => Pages\ViewStockTransferLine::route('/{record}'),
            'edit' => Pages\EditStockTransferLine::route('/{record}/edit'),
        ];
    }
}
