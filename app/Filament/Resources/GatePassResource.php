<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\GatePassResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\GatePass;

class GatePassResource extends MillResource
{
    protected static ?string $model = GatePass::class;

    protected static ?string $navigationGroup = 'Dispatch & Gate';

    protected static ?string $navigationLabel = 'Gate Passes';

    protected static ?int $navigationSort = 133;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGatePasses::route('/'),
            'create' => Pages\CreateGatePass::route('/create'),
            'view' => Pages\ViewGatePass::route('/{record}'),
            'edit' => Pages\EditGatePass::route('/{record}/edit'),
        ];
    }
}
