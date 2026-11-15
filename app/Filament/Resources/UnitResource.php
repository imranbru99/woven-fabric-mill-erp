<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\UnitResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Unit;

class UnitResource extends MillResource
{
    protected static ?string $model = Unit::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Units';

    protected static ?int $navigationSort = 4;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnits::route('/'),
            'create' => Pages\CreateUnit::route('/create'),
            'view' => Pages\ViewUnit::route('/{record}'),
            'edit' => Pages\EditUnit::route('/{record}/edit'),
        ];
    }
}
