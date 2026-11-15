<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\HsCodeResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\HsCode;

class HsCodeResource extends MillResource
{
    protected static ?string $model = HsCode::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'HS codes';

    protected static ?int $navigationSort = 31;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHsCodes::route('/'),
            'create' => Pages\CreateHsCode::route('/create'),
            'view' => Pages\ViewHsCode::route('/{record}'),
            'edit' => Pages\EditHsCode::route('/{record}/edit'),
        ];
    }
}
