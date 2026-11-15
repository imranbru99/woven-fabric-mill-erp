<?php

declare(strict_types=1);

namespace App\Filament\Resources\BeamPlanResource\Pages;

use App\Filament\Resources\BeamPlanResource;
use Filament\Resources\Pages\EditRecord;

class EditBeamPlan extends EditRecord
{
    protected static string $resource = BeamPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
