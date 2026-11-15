<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SalesContractResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SalesContract;

class SalesContractResource extends MillResource
{
    protected static ?string $model = SalesContract::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Sales Contracts';

    protected static ?int $navigationSort = 60;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSalesContracts::route('/'),
            'create' => Pages\CreateSalesContract::route('/create'),
            'view' => Pages\ViewSalesContract::route('/{record}'),
            'edit' => Pages\EditSalesContract::route('/{record}/edit'),
        ];
    }
}
