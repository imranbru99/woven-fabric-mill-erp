<?php

declare(strict_types=1);

namespace App\Filament\Resources\GoodsReceiptLineResource\Pages;

use App\Filament\Resources\GoodsReceiptLineResource;
use Filament\Resources\Pages\ListRecords;

class ListGoodsReceiptLines extends ListRecords
{
    protected static string $resource = GoodsReceiptLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
