<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BankAccountResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\BankAccount;

class BankAccountResource extends MillResource
{
    protected static ?string $model = BankAccount::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Bank Accounts';

    protected static ?int $navigationSort = 143;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBankAccounts::route('/'),
            'create' => Pages\CreateBankAccount::route('/create'),
            'view' => Pages\ViewBankAccount::route('/{record}'),
            'edit' => Pages\EditBankAccount::route('/{record}/edit'),
        ];
    }
}
