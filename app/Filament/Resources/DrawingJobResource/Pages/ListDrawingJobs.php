<?php

declare(strict_types=1);

namespace App\Filament\Resources\DrawingJobResource\Pages;

use App\Filament\Resources\DrawingJobResource;
use Filament\Resources\Pages\ListRecords;

class ListDrawingJobs extends ListRecords
{
    protected static string $resource = DrawingJobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
