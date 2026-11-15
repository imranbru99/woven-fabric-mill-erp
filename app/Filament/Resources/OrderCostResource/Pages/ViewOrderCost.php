<?php

declare(strict_types=1);

namespace App\Filament\Resources\OrderCostResource\Pages;

use App\Filament\Resources\OrderCostResource;
use Filament\Resources\Pages\ViewRecord;

class ViewOrderCost extends ViewRecord
{
    protected static string $resource = OrderCostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
