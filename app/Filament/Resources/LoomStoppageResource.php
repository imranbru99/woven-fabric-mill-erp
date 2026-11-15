<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\LoomStoppageResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\LoomStoppage;

class LoomStoppageResource extends MillResource
{
    protected static ?string $model = LoomStoppage::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Loom Stoppages';

    protected static ?int $navigationSort = 105;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoomStoppages::route('/'),
            'create' => Pages\CreateLoomStoppage::route('/create'),
            'view' => Pages\ViewLoomStoppage::route('/{record}'),
            'edit' => Pages\EditLoomStoppage::route('/{record}/edit'),
        ];
    }
}
