<?php

declare(strict_types=1);

namespace App\Filament\Resources\YarnRequirementResource\Pages;

use App\Filament\Resources\YarnRequirementResource;
use Filament\Resources\Pages\ViewRecord;

class ViewYarnRequirement extends ViewRecord
{
    protected static string $resource = YarnRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
