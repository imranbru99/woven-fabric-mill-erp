<?php

declare(strict_types=1);

namespace App\Filament\Resources\SampleRequestResource\Pages;

use App\Filament\Resources\SampleRequestResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSampleRequest extends ViewRecord
{
    protected static string $resource = SampleRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
