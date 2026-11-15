<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PermissionResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Permission;

class PermissionResource extends MillResource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationGroup = 'Access Control';

    protected static ?string $navigationLabel = 'Permissions';

    protected static ?int $navigationSort = 16;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'view' => Pages\ViewPermission::route('/{record}'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }
}
