<?php

declare(strict_types=1);

namespace App\Filament\Resources\PackingListLineResource\Pages;

use App\Filament\Resources\PackingListLineResource;
use Filament\Resources\Pages\EditRecord;

class EditPackingListLine extends EditRecord
{
    protected static string $resource = PackingListLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
