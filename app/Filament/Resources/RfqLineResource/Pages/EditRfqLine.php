<?php

declare(strict_types=1);

namespace App\Filament\Resources\RfqLineResource\Pages;

use App\Filament\Resources\RfqLineResource;
use Filament\Resources\Pages\EditRecord;

class EditRfqLine extends EditRecord
{
    protected static string $resource = RfqLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
