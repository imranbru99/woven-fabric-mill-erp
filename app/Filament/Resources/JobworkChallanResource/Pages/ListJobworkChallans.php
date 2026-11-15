<?php

declare(strict_types=1);

namespace App\Filament\Resources\JobworkChallanResource\Pages;

use App\Filament\Resources\JobworkChallanResource;
use Filament\Resources\Pages\ListRecords;

class ListJobworkChallans extends ListRecords
{
    protected static string $resource = JobworkChallanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
