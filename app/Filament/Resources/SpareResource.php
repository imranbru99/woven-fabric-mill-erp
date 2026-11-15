<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SpareResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Spare;

class SpareResource extends MillResource
{
    protected static ?string $model = Spare::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Spares';

    protected static ?int $navigationSort = 42;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpares::route('/'),
            'create' => Pages\CreateSpare::route('/create'),
            'view' => Pages\ViewSpare::route('/{record}'),
            'edit' => Pages\EditSpare::route('/{record}/edit'),
        ];
    }
}
