<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\LoomProductionResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\LoomProduction;

class LoomProductionResource extends MillResource
{
    protected static ?string $model = LoomProduction::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Loom Productions';

    protected static ?int $navigationSort = 104;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoomProductions::route('/'),
            'create' => Pages\CreateLoomProduction::route('/create'),
            'view' => Pages\ViewLoomProduction::route('/{record}'),
            'edit' => Pages\EditLoomProduction::route('/{record}/edit'),
        ];
    }
}
