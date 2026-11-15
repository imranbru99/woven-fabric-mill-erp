<?php

declare(strict_types=1);

namespace App\Filament\Resources\JobOpeningResource\Pages;

use App\Filament\Resources\JobOpeningResource;
use Filament\Resources\Pages\EditRecord;

class EditJobOpening extends EditRecord
{
    protected static string $resource = JobOpeningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
