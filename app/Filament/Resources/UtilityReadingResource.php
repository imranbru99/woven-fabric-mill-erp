<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\UtilityReadingResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\UtilityReading;

class UtilityReadingResource extends MillResource
{
    protected static ?string $model = UtilityReading::class;

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'Utility Readings';

    protected static ?int $navigationSort = 125;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUtilityReadings::route('/'),
            'create' => Pages\CreateUtilityReading::route('/create'),
            'view' => Pages\ViewUtilityReading::route('/{record}'),
            'edit' => Pages\EditUtilityReading::route('/{record}/edit'),
        ];
    }
}
