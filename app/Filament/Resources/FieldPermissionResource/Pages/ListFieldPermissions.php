<?php

declare(strict_types=1);

namespace App\Filament\Resources\FieldPermissionResource\Pages;

use App\Filament\Resources\FieldPermissionResource;
use Filament\Resources\Pages\ListRecords;

class ListFieldPermissions extends ListRecords
{
    protected static string $resource = FieldPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
