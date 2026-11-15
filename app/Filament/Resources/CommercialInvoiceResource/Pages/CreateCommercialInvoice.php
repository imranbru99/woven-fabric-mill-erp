<?php

declare(strict_types=1);

namespace App\Filament\Resources\CommercialInvoiceResource\Pages;

use App\Filament\Resources\CommercialInvoiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCommercialInvoice extends CreateRecord
{
    protected static string $resource = CommercialInvoiceResource::class;

}
