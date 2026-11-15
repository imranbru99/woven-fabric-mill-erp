<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\JournalLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\JournalLine;

class JournalLineResource extends MillResource
{
    protected static ?string $model = JournalLine::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Journal Lines';

    protected static ?int $navigationSort = 140;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJournalLines::route('/'),
            'create' => Pages\CreateJournalLine::route('/create'),
            'view' => Pages\ViewJournalLine::route('/{record}'),
            'edit' => Pages\EditJournalLine::route('/{record}/edit'),
        ];
    }
}
