<?php

declare(strict_types=1);

namespace App\Filament\Resources\DrawingJobResource\Pages;

use App\Filament\Resources\DrawingJobResource;
use Filament\Resources\Pages\EditRecord;

class EditDrawingJob extends EditRecord
{
    protected static string $resource = DrawingJobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
