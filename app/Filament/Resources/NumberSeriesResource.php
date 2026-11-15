<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\NumberSeriesResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\NumberSeries;

class NumberSeriesResource extends MillResource
{
    protected static ?string $model = NumberSeries::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Number Series';

    protected static ?int $navigationSort = 12;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNumberSeries::route('/'),
            'create' => Pages\CreateNumberSeries::route('/create'),
            'view' => Pages\ViewNumberSeries::route('/{record}'),
            'edit' => Pages\EditNumberSeries::route('/{record}/edit'),
        ];
    }
}
