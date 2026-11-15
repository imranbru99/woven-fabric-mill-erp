<?php

declare(strict_types=1);

namespace App\Filament\Resources\WarpingJobResource\Pages;

use App\Filament\Resources\WarpingJobResource;
use Filament\Resources\Pages\EditRecord;

class EditWarpingJob extends EditRecord
{
    protected static string $resource = WarpingJobResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
