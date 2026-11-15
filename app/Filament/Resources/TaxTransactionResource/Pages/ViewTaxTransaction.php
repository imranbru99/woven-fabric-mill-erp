<?php

declare(strict_types=1);

namespace App\Filament\Resources\TaxTransactionResource\Pages;

use App\Filament\Resources\TaxTransactionResource;
use Filament\Resources\Pages\ViewRecord;

class ViewTaxTransaction extends ViewRecord
{
    protected static string $resource = TaxTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
