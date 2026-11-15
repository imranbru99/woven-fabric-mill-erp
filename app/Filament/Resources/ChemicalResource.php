<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ChemicalResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Chemical;

class ChemicalResource extends MillResource
{
    protected static ?string $model = Chemical::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Chemicals';

    protected static ?int $navigationSort = 39;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChemicals::route('/'),
            'create' => Pages\CreateChemical::route('/create'),
            'view' => Pages\ViewChemical::route('/{record}'),
            'edit' => Pages\EditChemical::route('/{record}/edit'),
        ];
    }
}
