<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FiscalYearResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\FiscalYear;

class FiscalYearResource extends MillResource
{
    protected static ?string $model = FiscalYear::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Fiscal Years';

    protected static ?int $navigationSort = 10;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFiscalYears::route('/'),
            'create' => Pages\CreateFiscalYear::route('/create'),
            'view' => Pages\ViewFiscalYear::route('/{record}'),
            'edit' => Pages\EditFiscalYear::route('/{record}/edit'),
        ];
    }
}
