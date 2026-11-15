<?php

declare(strict_types=1);

namespace App\Filament\Resources\OrderCostResource\Pages;

use App\Filament\Resources\OrderCostResource;
use Filament\Resources\Pages\EditRecord;

class EditOrderCost extends EditRecord
{
    protected static string $resource = OrderCostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
