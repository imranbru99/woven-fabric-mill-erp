<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PriceListLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PriceListLine;

class PriceListLineResource extends MillResource
{
    protected static ?string $model = PriceListLine::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Price List Lines';

    protected static ?int $navigationSort = 65;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPriceListLines::route('/'),
            'create' => Pages\CreatePriceListLine::route('/create'),
            'view' => Pages\ViewPriceListLine::route('/{record}'),
            'edit' => Pages\EditPriceListLine::route('/{record}/edit'),
        ];
    }
}
