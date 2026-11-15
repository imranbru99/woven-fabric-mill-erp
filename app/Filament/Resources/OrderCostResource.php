<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\OrderCostResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\OrderCost;

class OrderCostResource extends MillResource
{
    protected static ?string $model = OrderCost::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Order Costs';

    protected static ?int $navigationSort = 151;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrderCosts::route('/'),
            'create' => Pages\CreateOrderCost::route('/create'),
            'view' => Pages\ViewOrderCost::route('/{record}'),
            'edit' => Pages\EditOrderCost::route('/{record}/edit'),
        ];
    }
}
