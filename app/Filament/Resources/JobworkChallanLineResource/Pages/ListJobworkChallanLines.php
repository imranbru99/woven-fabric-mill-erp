<?php

declare(strict_types=1);

namespace App\Filament\Resources\JobworkChallanLineResource\Pages;

use App\Filament\Resources\JobworkChallanLineResource;
use Filament\Resources\Pages\ListRecords;

class ListJobworkChallanLines extends ListRecords
{
    protected static string $resource = JobworkChallanLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
