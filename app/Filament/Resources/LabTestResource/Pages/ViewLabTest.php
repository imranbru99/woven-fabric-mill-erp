<?php

declare(strict_types=1);

namespace App\Filament\Resources\LabTestResource\Pages;

use App\Filament\Resources\LabTestResource;
use Filament\Resources\Pages\ViewRecord;

class ViewLabTest extends ViewRecord
{
    protected static string $resource = LabTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
