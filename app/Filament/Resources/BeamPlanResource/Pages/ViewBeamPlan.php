<?php

declare(strict_types=1);

namespace App\Filament\Resources\BeamPlanResource\Pages;

use App\Filament\Resources\BeamPlanResource;
use Filament\Resources\Pages\ViewRecord;

class ViewBeamPlan extends ViewRecord
{
    protected static string $resource = BeamPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
