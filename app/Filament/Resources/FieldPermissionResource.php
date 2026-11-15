<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FieldPermissionResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\FieldPermission;

class FieldPermissionResource extends MillResource
{
    protected static ?string $model = FieldPermission::class;

    protected static ?string $navigationGroup = 'Access Control';

    protected static ?string $navigationLabel = 'Field Permissions';

    protected static ?int $navigationSort = 17;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFieldPermissions::route('/'),
            'create' => Pages\CreateFieldPermission::route('/create'),
            'view' => Pages\ViewFieldPermission::route('/{record}'),
            'edit' => Pages\EditFieldPermission::route('/{record}/edit'),
        ];
    }
}
