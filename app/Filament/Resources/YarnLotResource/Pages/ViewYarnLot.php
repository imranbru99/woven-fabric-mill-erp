<?php

declare(strict_types=1);

namespace App\Filament\Resources\YarnLotResource\Pages;

use App\Filament\Resources\YarnLotResource;
use Filament\Resources\Pages\ViewRecord;

class ViewYarnLot extends ViewRecord
{
    protected static string $resource = YarnLotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
