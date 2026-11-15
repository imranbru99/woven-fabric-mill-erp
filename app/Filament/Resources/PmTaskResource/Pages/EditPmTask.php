<?php

declare(strict_types=1);

namespace App\Filament\Resources\PmTaskResource\Pages;

use App\Filament\Resources\PmTaskResource;
use Filament\Resources\Pages\EditRecord;

class EditPmTask extends EditRecord
{
    protected static string $resource = PmTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
