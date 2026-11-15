<?php

declare(strict_types=1);

namespace App\Filament\Resources\FieldPermissionResource\Pages;

use App\Filament\Resources\FieldPermissionResource;
use Filament\Resources\Pages\EditRecord;

class EditFieldPermission extends EditRecord
{
    protected static string $resource = FieldPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
