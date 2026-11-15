<?php

declare(strict_types=1);

namespace App\Filament\Resources\SalesOrderLineResource\Pages;

use App\Filament\Resources\SalesOrderLineResource;
use Filament\Resources\Pages\EditRecord;

class EditSalesOrderLine extends EditRecord
{
    protected static string $resource = SalesOrderLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
