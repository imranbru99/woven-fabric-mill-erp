<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ReedResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Reed;

class ReedResource extends MillResource
{
    protected static ?string $model = Reed::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Reeds';

    protected static ?int $navigationSort = 101;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReeds::route('/'),
            'create' => Pages\CreateReed::route('/create'),
            'view' => Pages\ViewReed::route('/{record}'),
            'edit' => Pages\EditReed::route('/{record}/edit'),
        ];
    }
}
