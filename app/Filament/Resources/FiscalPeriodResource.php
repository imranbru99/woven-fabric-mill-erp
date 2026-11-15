<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FiscalPeriodResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\FiscalPeriod;

class FiscalPeriodResource extends MillResource
{
    protected static ?string $model = FiscalPeriod::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Fiscal Periods';

    protected static ?int $navigationSort = 11;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFiscalPeriods::route('/'),
            'create' => Pages\CreateFiscalPeriod::route('/create'),
            'view' => Pages\ViewFiscalPeriod::route('/{record}'),
            'edit' => Pages\EditFiscalPeriod::route('/{record}/edit'),
        ];
    }
}
