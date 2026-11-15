<?php

declare(strict_types=1);

namespace App\Filament\Resources\WarpingJobResource\Pages;

use App\Filament\Resources\WarpingJobResource;
use Filament\Resources\Pages\ViewRecord;

class ViewWarpingJob extends ViewRecord
{
    protected static string $resource = WarpingJobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
