<?php

declare(strict_types=1);

namespace App\Filament\Resources\TaxTransactionResource\Pages;

use App\Filament\Resources\TaxTransactionResource;
use Filament\Resources\Pages\ListRecords;

class ListTaxTransactions extends ListRecords
{
    protected static string $resource = TaxTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
