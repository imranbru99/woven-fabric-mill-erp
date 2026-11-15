<?php

declare(strict_types=1);

namespace App\Filament\Resources\CommercialInvoiceResource\Pages;

use App\Filament\Resources\CommercialInvoiceResource;
use Filament\Resources\Pages\EditRecord;

class EditCommercialInvoice extends EditRecord
{
    protected static string $resource = CommercialInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
