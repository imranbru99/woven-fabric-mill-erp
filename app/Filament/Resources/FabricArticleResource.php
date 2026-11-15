<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FabricArticleResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\FabricArticle;

class FabricArticleResource extends MillResource
{
    protected static ?string $model = FabricArticle::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Fabric articles';

    protected static ?int $navigationSort = 38;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFabricArticles::route('/'),
            'create' => Pages\CreateFabricArticle::route('/create'),
            'view' => Pages\ViewFabricArticle::route('/{record}'),
            'edit' => Pages\EditFabricArticle::route('/{record}/edit'),
        ];
    }
}
