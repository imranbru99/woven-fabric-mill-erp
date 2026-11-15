<?php

declare(strict_types=1);

namespace App\Filament\Resources\BankLoanResource\Pages;

use App\Filament\Resources\BankLoanResource;
use Filament\Resources\Pages\EditRecord;

class EditBankLoan extends EditRecord
{
    protected static string $resource = BankLoanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
