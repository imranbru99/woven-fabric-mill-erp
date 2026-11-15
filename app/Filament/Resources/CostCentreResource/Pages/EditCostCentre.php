<?php

declare(strict_types=1);

namespace App\Filament\Resources\CostCentreResource\Pages;

use App\Filament\Resources\CostCentreResource;
use Filament\Resources\Pages\EditRecord;

class EditCostCentre extends EditRecord
{
    protected static string $resource = CostCentreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
