<?php

declare(strict_types=1);

namespace App\Filament\Resources\PurchaseOrderLineResource\Pages;

use App\Filament\Resources\PurchaseOrderLineResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePurchaseOrderLine extends CreateRecord
{
    protected static string $resource = PurchaseOrderLineResource::class;

}
