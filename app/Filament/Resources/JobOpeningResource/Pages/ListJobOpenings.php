<?php

declare(strict_types=1);

namespace App\Filament\Resources\JobOpeningResource\Pages;

use App\Filament\Resources\JobOpeningResource;
use Filament\Resources\Pages\ListRecords;

class ListJobOpenings extends ListRecords
{
    protected static string $resource = JobOpeningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
