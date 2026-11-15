<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PackingListResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PackingList;

class PackingListResource extends MillResource
{
    protected static ?string $model = PackingList::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Packing Lists';

    protected static ?int $navigationSort = 112;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackingLists::route('/'),
            'create' => Pages\CreatePackingList::route('/create'),
            'view' => Pages\ViewPackingList::route('/{record}'),
            'edit' => Pages\EditPackingList::route('/{record}/edit'),
        ];
    }
}
