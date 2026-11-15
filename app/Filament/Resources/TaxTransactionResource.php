<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\TaxTransactionResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\TaxTransaction;

class TaxTransactionResource extends MillResource
{
    protected static ?string $model = TaxTransaction::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Tax Transactions';

    protected static ?int $navigationSort = 150;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaxTransactions::route('/'),
            'create' => Pages\CreateTaxTransaction::route('/create'),
            'view' => Pages\ViewTaxTransaction::route('/{record}'),
            'edit' => Pages\EditTaxTransaction::route('/{record}/edit'),
        ];
    }
}
