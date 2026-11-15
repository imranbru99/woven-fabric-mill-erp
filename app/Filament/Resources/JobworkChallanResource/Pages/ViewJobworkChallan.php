<?php

declare(strict_types=1);

namespace App\Filament\Resources\JobworkChallanResource\Pages;

use App\Filament\Resources\JobworkChallanResource;
use Filament\Resources\Pages\ViewRecord;

class ViewJobworkChallan extends ViewRecord
{
    protected static string $resource = JobworkChallanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
