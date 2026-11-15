<?php

declare(strict_types=1);

namespace App\Filament\Resources\CommercialInvoiceResource\Pages;

use App\Filament\Resources\CommercialInvoiceResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCommercialInvoice extends ViewRecord
{
    protected static string $resource = CommercialInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
