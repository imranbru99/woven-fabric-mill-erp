<?php

declare(strict_types=1);

namespace App\Filament\Resources\LoomStoppageResource\Pages;

use App\Filament\Resources\LoomStoppageResource;
use Filament\Resources\Pages\ViewRecord;

class ViewLoomStoppage extends ViewRecord
{
    protected static string $resource = LoomStoppageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
