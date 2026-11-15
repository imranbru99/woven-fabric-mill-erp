<?php

declare(strict_types=1);

namespace App\Filament\Resources\FinishingBatchResource\Pages;

use App\Filament\Resources\FinishingBatchResource;
use Filament\Resources\Pages\EditRecord;

class EditFinishingBatch extends EditRecord
{
    protected static string $resource = FinishingBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
