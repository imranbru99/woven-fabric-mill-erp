<?php

declare(strict_types=1);

namespace App\Filament\Resources\JobworkChallanLineResource\Pages;

use App\Filament\Resources\JobworkChallanLineResource;
use Filament\Resources\Pages\ViewRecord;

class ViewJobworkChallanLine extends ViewRecord
{
    protected static string $resource = JobworkChallanLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
