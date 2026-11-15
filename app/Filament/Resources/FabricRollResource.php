<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FabricRollResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\FabricRoll;

class FabricRollResource extends MillResource
{
    protected static ?string $model = FabricRoll::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Fabric Rolls';

    protected static ?int $navigationSort = 106;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFabricRolls::route('/'),
            'create' => Pages\CreateFabricRoll::route('/create'),
            'view' => Pages\ViewFabricRoll::route('/{record}'),
            'edit' => Pages\EditFabricRoll::route('/{record}/edit'),
        ];
    }
}
