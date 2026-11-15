<?php

declare(strict_types=1);

namespace App\Filament\Resources\YarnRequirementResource\Pages;

use App\Filament\Resources\YarnRequirementResource;
use Filament\Resources\Pages\ListRecords;

class ListYarnRequirements extends ListRecords
{
    protected static string $resource = YarnRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
