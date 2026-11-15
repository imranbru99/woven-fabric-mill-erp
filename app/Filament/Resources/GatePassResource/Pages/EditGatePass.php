<?php

declare(strict_types=1);

namespace App\Filament\Resources\GatePassResource\Pages;

use App\Filament\Resources\GatePassResource;
use Filament\Resources\Pages\EditRecord;

class EditGatePass extends EditRecord
{
    protected static string $resource = GatePassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
