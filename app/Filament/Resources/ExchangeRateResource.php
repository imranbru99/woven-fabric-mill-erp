<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ExchangeRateResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\ExchangeRate;

class ExchangeRateResource extends MillResource
{
    protected static ?string $model = ExchangeRate::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Exchange Rates';

    protected static ?int $navigationSort = 14;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExchangeRates::route('/'),
            'create' => Pages\CreateExchangeRate::route('/create'),
            'view' => Pages\ViewExchangeRate::route('/{record}'),
            'edit' => Pages\EditExchangeRate::route('/{record}/edit'),
        ];
    }
}
