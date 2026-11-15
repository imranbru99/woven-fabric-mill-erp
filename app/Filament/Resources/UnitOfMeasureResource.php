<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\UnitOfMeasureResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\UnitOfMeasure;

class UnitOfMeasureResource extends MillResource
{
    protected static ?string $model = UnitOfMeasure::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Units of measure';

    protected static ?int $navigationSort = 27;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnitOfMeasures::route('/'),
            'create' => Pages\CreateUnitOfMeasure::route('/create'),
            'view' => Pages\ViewUnitOfMeasure::route('/{record}'),
            'edit' => Pages\EditUnitOfMeasure::route('/{record}/edit'),
        ];
    }
}
