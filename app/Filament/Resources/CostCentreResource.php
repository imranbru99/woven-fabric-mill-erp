<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CostCentreResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\CostCentre;

class CostCentreResource extends MillResource
{
    protected static ?string $model = CostCentre::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Cost Centres';

    protected static ?int $navigationSort = 7;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCostCentres::route('/'),
            'create' => Pages\CreateCostCentre::route('/create'),
            'view' => Pages\ViewCostCentre::route('/{record}'),
            'edit' => Pages\EditCostCentre::route('/{record}/edit'),
        ];
    }
}
