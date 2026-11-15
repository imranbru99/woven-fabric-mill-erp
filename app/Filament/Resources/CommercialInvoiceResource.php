<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CommercialInvoiceResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\CommercialInvoice;

class CommercialInvoiceResource extends MillResource
{
    protected static ?string $model = CommercialInvoice::class;

    protected static ?string $navigationGroup = 'Dispatch & Gate';

    protected static ?string $navigationLabel = 'Commercial Invoices';

    protected static ?int $navigationSort = 130;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommercialInvoices::route('/'),
            'create' => Pages\CreateCommercialInvoice::route('/create'),
            'view' => Pages\ViewCommercialInvoice::route('/{record}'),
            'edit' => Pages\EditCommercialInvoice::route('/{record}/edit'),
        ];
    }
}
