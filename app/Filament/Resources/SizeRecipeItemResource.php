<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SizeRecipeItemResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SizeRecipeItem;

class SizeRecipeItemResource extends MillResource
{
    protected static ?string $model = SizeRecipeItem::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Size Recipe Items';

    protected static ?int $navigationSort = 41;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSizeRecipeItems::route('/'),
            'create' => Pages\CreateSizeRecipeItem::route('/create'),
            'view' => Pages\ViewSizeRecipeItem::route('/{record}'),
            'edit' => Pages\EditSizeRecipeItem::route('/{record}/edit'),
        ];
    }
}
