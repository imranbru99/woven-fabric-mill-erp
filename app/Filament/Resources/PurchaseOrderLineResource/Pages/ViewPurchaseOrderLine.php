<?php

declare(strict_types=1);

namespace App\Filament\Resources\PurchaseOrderLineResource\Pages;

use App\Filament\Resources\PurchaseOrderLineResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPurchaseOrderLine extends ViewRecord
{
    protected static string $resource = PurchaseOrderLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
