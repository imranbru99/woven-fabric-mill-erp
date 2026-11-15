<?php

declare(strict_types=1);

namespace App\Filament\Resources\YarnLotResource\Pages;

use App\Filament\Resources\YarnLotResource;
use Filament\Resources\Pages\EditRecord;

class EditYarnLot extends EditRecord
{
    protected static string $resource = YarnLotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
