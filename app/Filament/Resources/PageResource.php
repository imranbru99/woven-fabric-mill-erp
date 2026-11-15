<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Page;

class PageResource extends MillResource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'CMS pages';

    protected static ?int $navigationSort = 170;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'view' => Pages\ViewPage::route('/{record}'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
