<?php

declare(strict_types=1);

namespace App\Filament\Resources\CommercialInvoiceLineResource\Pages;

use App\Filament\Resources\CommercialInvoiceLineResource;
use Filament\Resources\Pages\ListRecords;

class ListCommercialInvoiceLines extends ListRecords
{
    protected static string $resource = CommercialInvoiceLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
