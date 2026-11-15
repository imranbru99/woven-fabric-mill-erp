<?php

declare(strict_types=1);

namespace App\Filament\Resources\YarnRequirementResource\Pages;

use App\Filament\Resources\YarnRequirementResource;
use Filament\Resources\Pages\EditRecord;

class EditYarnRequirement extends EditRecord
{
    protected static string $resource = YarnRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
