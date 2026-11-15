<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RfqLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\RfqLine;

class RfqLineResource extends MillResource
{
    protected static ?string $model = RfqLine::class;

    protected static ?string $navigationGroup = 'Procurement';

    protected static ?string $navigationLabel = 'Rfq Lines';

    protected static ?int $navigationSort = 69;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRfqLines::route('/'),
            'create' => Pages\CreateRfqLine::route('/create'),
            'view' => Pages\ViewRfqLine::route('/{record}'),
            'edit' => Pages\EditRfqLine::route('/{record}/edit'),
        ];
    }
}
