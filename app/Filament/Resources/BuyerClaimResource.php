<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BuyerClaimResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\BuyerClaim;

class BuyerClaimResource extends MillResource
{
    protected static ?string $model = BuyerClaim::class;

    protected static ?string $navigationGroup = 'Quality';

    protected static ?string $navigationLabel = 'Buyer Claims';

    protected static ?int $navigationSort = 119;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBuyerClaims::route('/'),
            'create' => Pages\CreateBuyerClaim::route('/create'),
            'view' => Pages\ViewBuyerClaim::route('/{record}'),
            'edit' => Pages\EditBuyerClaim::route('/{record}/edit'),
        ];
    }
}
