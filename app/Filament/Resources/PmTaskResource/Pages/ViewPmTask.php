<?php

declare(strict_types=1);

namespace App\Filament\Resources\PmTaskResource\Pages;

use App\Filament\Resources\PmTaskResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPmTask extends ViewRecord
{
    protected static string $resource = PmTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
