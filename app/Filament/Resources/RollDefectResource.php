<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RollDefectResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\RollDefect;

class RollDefectResource extends MillResource
{
    protected static ?string $model = RollDefect::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Roll Defects';

    protected static ?int $navigationSort = 107;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRollDefects::route('/'),
            'create' => Pages\CreateRollDefect::route('/create'),
            'view' => Pages\ViewRollDefect::route('/{record}'),
            'edit' => Pages\EditRollDefect::route('/{record}/edit'),
        ];
    }
}
