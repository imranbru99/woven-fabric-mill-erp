<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\InstrumentResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Instrument;

class InstrumentResource extends MillResource
{
    protected static ?string $model = Instrument::class;

    protected static ?string $navigationGroup = 'Quality';

    protected static ?string $navigationLabel = 'Instruments';

    protected static ?int $navigationSort = 116;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstruments::route('/'),
            'create' => Pages\CreateInstrument::route('/create'),
            'view' => Pages\ViewInstrument::route('/{record}'),
            'edit' => Pages\EditInstrument::route('/{record}/edit'),
        ];
    }
}
