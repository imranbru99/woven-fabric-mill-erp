<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\YarnResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Yarn;

class YarnResource extends MillResource
{
    protected static ?string $model = Yarn::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Yarns';

    protected static ?int $navigationSort = 36;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListYarns::route('/'),
            'create' => Pages\CreateYarn::route('/create'),
            'view' => Pages\ViewYarn::route('/{record}'),
            'edit' => Pages\EditYarn::route('/{record}/edit'),
        ];
    }
}
