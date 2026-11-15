<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ShiftResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Shift;

class ShiftResource extends MillResource
{
    protected static ?string $model = Shift::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Shifts';

    protected static ?int $navigationSort = 8;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShifts::route('/'),
            'create' => Pages\CreateShift::route('/create'),
            'view' => Pages\ViewShift::route('/{record}'),
            'edit' => Pages\EditShift::route('/{record}/edit'),
        ];
    }
}
