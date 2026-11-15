<?php

declare(strict_types=1);

namespace App\Filament\Resources\CommercialInvoiceLineResource\Pages;

use App\Filament\Resources\CommercialInvoiceLineResource;
use Filament\Resources\Pages\EditRecord;

class EditCommercialInvoiceLine extends EditRecord
{
    protected static string $resource = CommercialInvoiceLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
