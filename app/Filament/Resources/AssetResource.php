<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Asset;

class AssetResource extends MillResource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'Assets';

    protected static ?int $navigationSort = 120;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'view' => Pages\ViewAsset::route('/{record}'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}
