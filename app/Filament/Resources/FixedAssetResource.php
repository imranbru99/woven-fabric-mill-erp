<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FixedAssetResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\FixedAsset;

class FixedAssetResource extends MillResource
{
    protected static ?string $model = FixedAsset::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Fixed Assets';

    protected static ?int $navigationSort = 146;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFixedAssets::route('/'),
            'create' => Pages\CreateFixedAsset::route('/create'),
            'view' => Pages\ViewFixedAsset::route('/{record}'),
            'edit' => Pages\EditFixedAsset::route('/{record}/edit'),
        ];
    }
}
