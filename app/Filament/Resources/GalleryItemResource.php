<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\GalleryItem;

class GalleryItemResource extends MillResource
{
    protected static ?string $model = GalleryItem::class;

    protected static ?string $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Gallery Items';

    protected static ?int $navigationSort = 174;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'view' => Pages\ViewGalleryItem::route('/{record}'),
            'edit' => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }
}
