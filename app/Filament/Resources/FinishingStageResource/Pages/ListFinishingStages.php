<?php

declare(strict_types=1);

namespace App\Filament\Resources\FinishingStageResource\Pages;

use App\Filament\Resources\FinishingStageResource;
use Filament\Resources\Pages\ListRecords;

class ListFinishingStages extends ListRecords
{
    protected static string $resource = FinishingStageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
