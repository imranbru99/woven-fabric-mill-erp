<?php

declare(strict_types=1);

namespace App\Filament\Resources\FinishingStageResource\Pages;

use App\Filament\Resources\FinishingStageResource;
use Filament\Resources\Pages\ViewRecord;

class ViewFinishingStage extends ViewRecord
{
    protected static string $resource = FinishingStageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
