<?php

declare(strict_types=1);

namespace App\Filament\Resources\PortResource\Pages;

use App\Filament\Resources\PortResource;
use Filament\Resources\Pages\EditRecord;

class EditPort extends EditRecord
{
    protected static string $resource = PortResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
