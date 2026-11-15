<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\IncotermResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Incoterm;

class IncotermResource extends MillResource
{
    protected static ?string $model = Incoterm::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Incoterms';

    protected static ?int $navigationSort = 34;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIncoterms::route('/'),
            'create' => Pages\CreateIncoterm::route('/create'),
            'view' => Pages\ViewIncoterm::route('/{record}'),
            'edit' => Pages\EditIncoterm::route('/{record}/edit'),
        ];
    }
}
