<?php

declare(strict_types=1);

namespace App\Filament\Resources\AmcContractResource\Pages;

use App\Filament\Resources\AmcContractResource;
use Filament\Resources\Pages\EditRecord;

class EditAmcContract extends EditRecord
{
    protected static string $resource = AmcContractResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
