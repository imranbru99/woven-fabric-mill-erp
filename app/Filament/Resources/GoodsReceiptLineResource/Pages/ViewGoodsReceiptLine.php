<?php

declare(strict_types=1);

namespace App\Filament\Resources\GoodsReceiptLineResource\Pages;

use App\Filament\Resources\GoodsReceiptLineResource;
use Filament\Resources\Pages\ViewRecord;

class ViewGoodsReceiptLine extends ViewRecord
{
    protected static string $resource = GoodsReceiptLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
