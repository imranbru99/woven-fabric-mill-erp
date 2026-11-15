<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SizingLogResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SizingLog;

class SizingLogResource extends MillResource
{
    protected static ?string $model = SizingLog::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Sizing Logs';

    protected static ?int $navigationSort = 98;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSizingLogs::route('/'),
            'create' => Pages\CreateSizingLog::route('/create'),
            'view' => Pages\ViewSizingLog::route('/{record}'),
            'edit' => Pages\EditSizingLog::route('/{record}/edit'),
        ];
    }
}
