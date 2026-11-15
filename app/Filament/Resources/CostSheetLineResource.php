<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CostSheetLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\CostSheetLine;

class CostSheetLineResource extends MillResource
{
    protected static ?string $model = CostSheetLine::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Cost Sheet Lines';

    protected static ?int $navigationSort = 55;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCostSheetLines::route('/'),
            'create' => Pages\CreateCostSheetLine::route('/create'),
            'view' => Pages\ViewCostSheetLine::route('/{record}'),
            'edit' => Pages\EditCostSheetLine::route('/{record}/edit'),
        ];
    }
}
