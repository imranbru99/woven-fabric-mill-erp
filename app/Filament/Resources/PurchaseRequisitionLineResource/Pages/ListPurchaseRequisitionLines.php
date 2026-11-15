<?php

declare(strict_types=1);

namespace App\Filament\Resources\PurchaseRequisitionLineResource\Pages;

use App\Filament\Resources\PurchaseRequisitionLineResource;
use Filament\Resources\Pages\ListRecords;

class ListPurchaseRequisitionLines extends ListRecords
{
    protected static string $resource = PurchaseRequisitionLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
