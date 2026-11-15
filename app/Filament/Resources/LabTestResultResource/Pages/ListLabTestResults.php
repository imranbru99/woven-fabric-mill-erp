<?php

declare(strict_types=1);

namespace App\Filament\Resources\LabTestResultResource\Pages;

use App\Filament\Resources\LabTestResultResource;
use Filament\Resources\Pages\ListRecords;

class ListLabTestResults extends ListRecords
{
    protected static string $resource = LabTestResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
