<?php

declare(strict_types=1);

namespace App\Filament\Resources\PmScheduleResource\Pages;

use App\Filament\Resources\PmScheduleResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPmSchedule extends ViewRecord
{
    protected static string $resource = PmScheduleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
