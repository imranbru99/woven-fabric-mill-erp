<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CommercialInvoiceLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\CommercialInvoiceLine;

class CommercialInvoiceLineResource extends MillResource
{
    protected static ?string $model = CommercialInvoiceLine::class;

    protected static ?string $navigationGroup = 'Dispatch & Gate';

    protected static ?string $navigationLabel = 'Commercial Invoice Lines';

    protected static ?int $navigationSort = 131;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommercialInvoiceLines::route('/'),
            'create' => Pages\CreateCommercialInvoiceLine::route('/create'),
            'view' => Pages\ViewCommercialInvoiceLine::route('/{record}'),
            'edit' => Pages\EditCommercialInvoiceLine::route('/{record}/edit'),
        ];
    }
}
