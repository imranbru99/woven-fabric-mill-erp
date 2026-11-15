<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SalesOrderLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SalesOrderLine;

class SalesOrderLineResource extends MillResource
{
    protected static ?string $model = SalesOrderLine::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Sales Order Lines';

    protected static ?int $navigationSort = 63;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSalesOrderLines::route('/'),
            'create' => Pages\CreateSalesOrderLine::route('/create'),
            'view' => Pages\ViewSalesOrderLine::route('/{record}'),
            'edit' => Pages\EditSalesOrderLine::route('/{record}/edit'),
        ];
    }
}
