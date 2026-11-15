<?php

declare(strict_types=1);

namespace App\Filament\Resources\PurchaseRequisitionLineResource\Pages;

use App\Filament\Resources\PurchaseRequisitionLineResource;
use Filament\Resources\Pages\EditRecord;

class EditPurchaseRequisitionLine extends EditRecord
{
    protected static string $resource = PurchaseRequisitionLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
