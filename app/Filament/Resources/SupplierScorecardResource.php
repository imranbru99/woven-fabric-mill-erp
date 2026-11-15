<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierScorecardResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SupplierScorecard;

class SupplierScorecardResource extends MillResource
{
    protected static ?string $model = SupplierScorecard::class;

    protected static ?string $navigationGroup = 'Procurement';

    protected static ?string $navigationLabel = 'Supplier Scorecards';

    protected static ?int $navigationSort = 77;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupplierScorecards::route('/'),
            'create' => Pages\CreateSupplierScorecard::route('/create'),
            'view' => Pages\ViewSupplierScorecard::route('/{record}'),
            'edit' => Pages\EditSupplierScorecard::route('/{record}/edit'),
        ];
    }
}
