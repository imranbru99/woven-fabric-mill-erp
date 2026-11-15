<?php

declare(strict_types=1);

namespace App\Filament\Resources\SizingBatchResource\Pages;

use App\Filament\Resources\SizingBatchResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSizingBatch extends ViewRecord
{
    protected static string $resource = SizingBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
