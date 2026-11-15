<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\GoodsReceiptLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\GoodsReceiptLine;

class GoodsReceiptLineResource extends MillResource
{
    protected static ?string $model = GoodsReceiptLine::class;

    protected static ?string $navigationGroup = 'Inventory';

    protected static ?string $navigationLabel = 'Goods Receipt Lines';

    protected static ?int $navigationSort = 79;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGoodsReceiptLines::route('/'),
            'create' => Pages\CreateGoodsReceiptLine::route('/create'),
            'view' => Pages\ViewGoodsReceiptLine::route('/{record}'),
            'edit' => Pages\EditGoodsReceiptLine::route('/{record}/edit'),
        ];
    }
}
