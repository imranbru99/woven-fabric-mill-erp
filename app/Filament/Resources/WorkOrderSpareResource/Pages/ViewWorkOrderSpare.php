<?php

declare(strict_types=1);

namespace App\Filament\Resources\WorkOrderSpareResource\Pages;

use App\Filament\Resources\WorkOrderSpareResource;
use Filament\Resources\Pages\ViewRecord;

class ViewWorkOrderSpare extends ViewRecord
{
    protected static string $resource = WorkOrderSpareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
