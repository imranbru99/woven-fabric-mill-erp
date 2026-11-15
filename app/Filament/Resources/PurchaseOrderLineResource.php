<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseOrderLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PurchaseOrderLine;

class PurchaseOrderLineResource extends MillResource
{
    protected static ?string $model = PurchaseOrderLine::class;

    protected static ?string $navigationGroup = 'Procurement';

    protected static ?string $navigationLabel = 'Purchase Order Lines';

    protected static ?int $navigationSort = 72;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchaseOrderLines::route('/'),
            'create' => Pages\CreatePurchaseOrderLine::route('/create'),
            'view' => Pages\ViewPurchaseOrderLine::route('/{record}'),
            'edit' => Pages\EditPurchaseOrderLine::route('/{record}/edit'),
        ];
    }
}
