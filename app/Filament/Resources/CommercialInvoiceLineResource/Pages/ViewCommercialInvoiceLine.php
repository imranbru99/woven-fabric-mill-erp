<?php

declare(strict_types=1);

namespace App\Filament\Resources\CommercialInvoiceLineResource\Pages;

use App\Filament\Resources\CommercialInvoiceLineResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCommercialInvoiceLine extends ViewRecord
{
    protected static string $resource = CommercialInvoiceLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
