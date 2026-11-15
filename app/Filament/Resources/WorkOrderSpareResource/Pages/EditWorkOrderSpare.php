<?php

declare(strict_types=1);

namespace App\Filament\Resources\WorkOrderSpareResource\Pages;

use App\Filament\Resources\WorkOrderSpareResource;
use Filament\Resources\Pages\EditRecord;

class EditWorkOrderSpare extends EditRecord
{
    protected static string $resource = WorkOrderSpareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
