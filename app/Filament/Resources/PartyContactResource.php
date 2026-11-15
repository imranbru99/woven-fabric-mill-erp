<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PartyContactResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PartyContact;

class PartyContactResource extends MillResource
{
    protected static ?string $model = PartyContact::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Party Contacts';

    protected static ?int $navigationSort = 30;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartyContacts::route('/'),
            'create' => Pages\CreatePartyContact::route('/create'),
            'view' => Pages\ViewPartyContact::route('/{record}'),
            'edit' => Pages\EditPartyContact::route('/{record}/edit'),
        ];
    }
}
