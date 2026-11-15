<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierClaimResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SupplierClaim;

class SupplierClaimResource extends MillResource
{
    protected static ?string $model = SupplierClaim::class;

    protected static ?string $navigationGroup = 'Procurement';

    protected static ?string $navigationLabel = 'Supplier Claims';

    protected static ?int $navigationSort = 76;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupplierClaims::route('/'),
            'create' => Pages\CreateSupplierClaim::route('/create'),
            'view' => Pages\ViewSupplierClaim::route('/{record}'),
            'edit' => Pages\EditSupplierClaim::route('/{record}/edit'),
        ];
    }
}
