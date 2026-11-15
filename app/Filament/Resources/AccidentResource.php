<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\AccidentResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Accident;

class AccidentResource extends MillResource
{
    protected static ?string $model = Accident::class;

    protected static ?string $navigationGroup = 'HR & Payroll';

    protected static ?string $navigationLabel = 'Accidents';

    protected static ?int $navigationSort = 163;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccidents::route('/'),
            'create' => Pages\CreateAccident::route('/create'),
            'view' => Pages\ViewAccident::route('/{record}'),
            'edit' => Pages\EditAccident::route('/{record}/edit'),
        ];
    }
}
