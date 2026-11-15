<?php

declare(strict_types=1);

namespace App\Filament\Resources\SalesOrderLineResource\Pages;

use App\Filament\Resources\SalesOrderLineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSalesOrderLine extends CreateRecord
{
    protected static string $resource = SalesOrderLineResource::class;

}
