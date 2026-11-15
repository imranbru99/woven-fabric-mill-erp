<?php

declare(strict_types=1);

namespace App\Filament\Resources\CostSheetLineResource\Pages;

use App\Filament\Resources\CostSheetLineResource;
use Filament\Resources\Pages\EditRecord;

class EditCostSheetLine extends EditRecord
{
    protected static string $resource = CostSheetLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
