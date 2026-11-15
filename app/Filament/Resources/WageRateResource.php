<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\WageRateResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\WageRate;

class WageRateResource extends MillResource
{
    protected static ?string $model = WageRate::class;

    protected static ?string $navigationGroup = 'HR & Payroll';

    protected static ?string $navigationLabel = 'Wage Rates';

    protected static ?int $navigationSort = 156;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWageRates::route('/'),
            'create' => Pages\CreateWageRate::route('/create'),
            'view' => Pages\ViewWageRate::route('/{record}'),
            'edit' => Pages\EditWageRate::route('/{record}/edit'),
        ];
    }
}
