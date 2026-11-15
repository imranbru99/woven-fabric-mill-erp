<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BankLoanResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\BankLoan;

class BankLoanResource extends MillResource
{
    protected static ?string $model = BankLoan::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Bank Loans';

    protected static ?int $navigationSort = 152;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankLoans::route('/'),
            'create' => Pages\CreateBankLoan::route('/create'),
            'view' => Pages\ViewBankLoan::route('/{record}'),
            'edit' => Pages\EditBankLoan::route('/{record}/edit'),
        ];
    }
}
