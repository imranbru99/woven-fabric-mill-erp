<?php

declare(strict_types=1);

namespace App\Filament\Resources\TaxTransactionResource\Pages;

use App\Filament\Resources\TaxTransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTaxTransaction extends CreateRecord
{
    protected static string $resource = TaxTransactionResource::class;

}
