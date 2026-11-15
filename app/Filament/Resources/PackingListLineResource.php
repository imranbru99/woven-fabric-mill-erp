<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PackingListLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PackingListLine;

class PackingListLineResource extends MillResource
{
    protected static ?string $model = PackingListLine::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Packing List Lines';

    protected static ?int $navigationSort = 113;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackingListLines::route('/'),
            'create' => Pages\CreatePackingListLine::route('/create'),
            'view' => Pages\ViewPackingListLine::route('/{record}'),
            'edit' => Pages\EditPackingListLine::route('/{record}/edit'),
        ];
    }
}
