<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CostSheetResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\CostSheet;

class CostSheetResource extends MillResource
{
    protected static ?string $model = CostSheet::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Cost Sheets';

    protected static ?int $navigationSort = 54;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCostSheets::route('/'),
            'create' => Pages\CreateCostSheet::route('/create'),
            'view' => Pages\ViewCostSheet::route('/{record}'),
            'edit' => Pages\EditCostSheet::route('/{record}/edit'),
        ];
    }
}
