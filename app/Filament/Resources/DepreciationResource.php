<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\DepreciationResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Depreciation;

class DepreciationResource extends MillResource
{
    protected static ?string $model = Depreciation::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Depreciations';

    protected static ?int $navigationSort = 147;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepreciations::route('/'),
            'create' => Pages\CreateDepreciation::route('/create'),
            'view' => Pages\ViewDepreciation::route('/{record}'),
            'edit' => Pages\EditDepreciation::route('/{record}/edit'),
        ];
    }
}
