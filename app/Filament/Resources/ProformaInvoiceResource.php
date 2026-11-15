<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProformaInvoiceResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\ProformaInvoice;

class ProformaInvoiceResource extends MillResource
{
    protected static ?string $model = ProformaInvoice::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Proforma invoices';

    protected static ?int $navigationSort = 58;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProformaInvoices::route('/'),
            'create' => Pages\CreateProformaInvoice::route('/create'),
            'view' => Pages\ViewProformaInvoice::route('/{record}'),
            'edit' => Pages\EditProformaInvoice::route('/{record}/edit'),
        ];
    }
}
