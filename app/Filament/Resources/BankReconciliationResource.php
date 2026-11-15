<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BankReconciliationResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\BankReconciliation;

class BankReconciliationResource extends MillResource
{
    protected static ?string $model = BankReconciliation::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Bank Reconciliations';

    protected static ?int $navigationSort = 145;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankReconciliations::route('/'),
            'create' => Pages\CreateBankReconciliation::route('/create'),
            'view' => Pages\ViewBankReconciliation::route('/{record}'),
            'edit' => Pages\EditBankReconciliation::route('/{record}/edit'),
        ];
    }
}
