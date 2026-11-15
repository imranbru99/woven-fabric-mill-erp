<?php

declare(strict_types=1);

namespace App\Filament\Resources\PurchaseRequisitionLineResource\Pages;

use App\Filament\Resources\PurchaseRequisitionLineResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPurchaseRequisitionLine extends ViewRecord
{
    protected static string $resource = PurchaseRequisitionLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
