<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SalesOrderResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SalesOrder;

class SalesOrderResource extends MillResource
{
    protected static ?string $model = SalesOrder::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Sales Orders';

    protected static ?int $navigationSort = 62;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSalesOrders::route('/'),
            'create' => Pages\CreateSalesOrder::route('/create'),
            'view' => Pages\ViewSalesOrder::route('/{record}'),
            'edit' => Pages\EditSalesOrder::route('/{record}/edit'),
        ];
    }
}
