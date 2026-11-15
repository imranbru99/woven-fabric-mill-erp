<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PartyResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Party;

class PartyResource extends MillResource
{
    protected static ?string $model = Party::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Parties';

    protected static ?int $navigationSort = 29;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParties::route('/'),
            'create' => Pages\CreateParty::route('/create'),
            'view' => Pages\ViewParty::route('/{record}'),
            'edit' => Pages\EditParty::route('/{record}/edit'),
        ];
    }
}
