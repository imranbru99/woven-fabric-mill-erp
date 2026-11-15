<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\LandedCostResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\LandedCost;

class LandedCostResource extends MillResource
{
    protected static ?string $model = LandedCost::class;

    protected static ?string $navigationGroup = 'Procurement';

    protected static ?string $navigationLabel = 'Landed Costs';

    protected static ?int $navigationSort = 75;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLandedCosts::route('/'),
            'create' => Pages\CreateLandedCost::route('/create'),
            'view' => Pages\ViewLandedCost::route('/{record}'),
            'edit' => Pages\EditLandedCost::route('/{record}/edit'),
        ];
    }
}
