<?php

declare(strict_types=1);

namespace App\Filament\Resources\LabTestResultResource\Pages;

use App\Filament\Resources\LabTestResultResource;
use Filament\Resources\Pages\EditRecord;

class EditLabTestResult extends EditRecord
{
    protected static string $resource = LabTestResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
