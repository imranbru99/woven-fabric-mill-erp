<?php

declare(strict_types=1);

namespace App\Filament\Resources\CommercialInvoiceLineResource\Pages;

use App\Filament\Resources\CommercialInvoiceLineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCommercialInvoiceLine extends CreateRecord
{
    protected static string $resource = CommercialInvoiceLineResource::class;

}
