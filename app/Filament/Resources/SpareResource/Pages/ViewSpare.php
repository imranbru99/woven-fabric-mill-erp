<?php

declare(strict_types=1);

namespace App\Filament\Resources\SpareResource\Pages;

use App\Filament\Resources\SpareResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSpare extends ViewRecord
{
    protected static string $resource = SpareResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
