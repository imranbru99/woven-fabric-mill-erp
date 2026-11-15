<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Post;

class PostResource extends MillResource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'News';

    protected static ?int $navigationSort = 171;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
