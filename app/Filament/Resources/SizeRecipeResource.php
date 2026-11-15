<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SizeRecipeResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SizeRecipe;

class SizeRecipeResource extends MillResource
{
    protected static ?string $model = SizeRecipe::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Size Recipes';

    protected static ?int $navigationSort = 40;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSizeRecipes::route('/'),
            'create' => Pages\CreateSizeRecipe::route('/create'),
            'view' => Pages\ViewSizeRecipe::route('/{record}'),
            'edit' => Pages\EditSizeRecipe::route('/{record}/edit'),
        ];
    }
}
