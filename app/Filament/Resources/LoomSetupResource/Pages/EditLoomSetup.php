<?php

declare(strict_types=1);

namespace App\Filament\Resources\LoomSetupResource\Pages;

use App\Filament\Resources\LoomSetupResource;
use Filament\Resources\Pages\EditRecord;

class EditLoomSetup extends EditRecord
{
    protected static string $resource = LoomSetupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
