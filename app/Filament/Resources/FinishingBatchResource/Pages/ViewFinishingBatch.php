<?php

declare(strict_types=1);

namespace App\Filament\Resources\FinishingBatchResource\Pages;

use App\Filament\Resources\FinishingBatchResource;
use Filament\Resources\Pages\ViewRecord;

class ViewFinishingBatch extends ViewRecord
{
    protected static string $resource = FinishingBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
