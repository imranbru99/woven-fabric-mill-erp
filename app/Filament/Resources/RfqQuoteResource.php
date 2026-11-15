<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RfqQuoteResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\RfqQuote;

class RfqQuoteResource extends MillResource
{
    protected static ?string $model = RfqQuote::class;

    protected static ?string $navigationGroup = 'Procurement';

    protected static ?string $navigationLabel = 'Rfq Quotes';

    protected static ?int $navigationSort = 70;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRfqQuotes::route('/'),
            'create' => Pages\CreateRfqQuote::route('/create'),
            'view' => Pages\ViewRfqQuote::route('/{record}'),
            'edit' => Pages\EditRfqQuote::route('/{record}/edit'),
        ];
    }
}
