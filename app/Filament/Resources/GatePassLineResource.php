<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\GatePassLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\GatePassLine;

class GatePassLineResource extends MillResource
{
    protected static ?string $model = GatePassLine::class;

    protected static ?string $navigationGroup = 'Dispatch & Gate';

    protected static ?string $navigationLabel = 'Gate Pass Lines';

    protected static ?int $navigationSort = 134;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGatePassLines::route('/'),
            'create' => Pages\CreateGatePassLine::route('/create'),
            'view' => Pages\ViewGatePassLine::route('/{record}'),
            'edit' => Pages\EditGatePassLine::route('/{record}/edit'),
        ];
    }
}
