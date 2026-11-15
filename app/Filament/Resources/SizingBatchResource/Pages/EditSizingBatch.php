<?php

declare(strict_types=1);

namespace App\Filament\Resources\SizingBatchResource\Pages;

use App\Filament\Resources\SizingBatchResource;
use Filament\Resources\Pages\EditRecord;

class EditSizingBatch extends EditRecord
{
    protected static string $resource = SizingBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
