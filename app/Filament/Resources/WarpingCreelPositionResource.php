<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\WarpingCreelPositionResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\WarpingCreelPosition;

class WarpingCreelPositionResource extends MillResource
{
    protected static ?string $model = WarpingCreelPosition::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Warping Creel Positions';

    protected static ?int $navigationSort = 95;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWarpingCreelPositions::route('/'),
            'create' => Pages\CreateWarpingCreelPosition::route('/create'),
            'view' => Pages\ViewWarpingCreelPosition::route('/{record}'),
            'edit' => Pages\EditWarpingCreelPosition::route('/{record}/edit'),
        ];
    }
}
