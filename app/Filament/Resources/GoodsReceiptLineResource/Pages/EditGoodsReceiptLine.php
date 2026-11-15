<?php

declare(strict_types=1);

namespace App\Filament\Resources\GoodsReceiptLineResource\Pages;

use App\Filament\Resources\GoodsReceiptLineResource;
use Filament\Resources\Pages\EditRecord;

class EditGoodsReceiptLine extends EditRecord
{
    protected static string $resource = GoodsReceiptLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
