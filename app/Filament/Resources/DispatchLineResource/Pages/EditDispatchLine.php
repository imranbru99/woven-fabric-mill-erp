<?php

declare(strict_types=1);

namespace App\Filament\Resources\DispatchLineResource\Pages;

use App\Filament\Resources\DispatchLineResource;
use Filament\Resources\Pages\EditRecord;

class EditDispatchLine extends EditRecord
{
    protected static string $resource = DispatchLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
