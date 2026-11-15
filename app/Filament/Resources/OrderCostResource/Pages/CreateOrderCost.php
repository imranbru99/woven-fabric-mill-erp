<?php

declare(strict_types=1);

namespace App\Filament\Resources\OrderCostResource\Pages;

use App\Filament\Resources\OrderCostResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrderCost extends CreateRecord
{
    protected static string $resource = OrderCostResource::class;

}
