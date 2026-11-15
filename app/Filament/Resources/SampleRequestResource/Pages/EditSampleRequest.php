<?php

declare(strict_types=1);

namespace App\Filament\Resources\SampleRequestResource\Pages;

use App\Filament\Resources\SampleRequestResource;
use Filament\Resources\Pages\EditRecord;

class EditSampleRequest extends EditRecord
{
    protected static string $resource = SampleRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
