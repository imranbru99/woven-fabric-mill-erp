<?php

declare(strict_types=1);

namespace App\Filament\Resources\SecurityRoundResource\Pages;

use App\Filament\Resources\SecurityRoundResource;
use Filament\Resources\Pages\EditRecord;

class EditSecurityRound extends EditRecord
{
    protected static string $resource = SecurityRoundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
