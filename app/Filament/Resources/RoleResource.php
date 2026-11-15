<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Role;

class RoleResource extends MillResource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationGroup = 'Access Control';

    protected static ?string $navigationLabel = 'Roles';

    protected static ?int $navigationSort = 15;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'view' => Pages\ViewRole::route('/{record}'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
