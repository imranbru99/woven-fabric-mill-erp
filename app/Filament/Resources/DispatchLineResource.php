<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\DispatchLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\DispatchLine;

class DispatchLineResource extends MillResource
{
    protected static ?string $model = DispatchLine::class;

    protected static ?string $navigationGroup = 'Dispatch & Gate';

    protected static ?string $navigationLabel = 'Dispatch Lines';

    protected static ?int $navigationSort = 129;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDispatchLines::route('/'),
            'create' => Pages\CreateDispatchLine::route('/create'),
            'view' => Pages\ViewDispatchLine::route('/{record}'),
            'edit' => Pages\EditDispatchLine::route('/{record}/edit'),
        ];
    }
}
