<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\AmcContractResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\AmcContract;

class AmcContractResource extends MillResource
{
    protected static ?string $model = AmcContract::class;

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'AMC contracts';

    protected static ?int $navigationSort = 127;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAmcContracts::route('/'),
            'create' => Pages\CreateAmcContract::route('/create'),
            'view' => Pages\ViewAmcContract::route('/{record}'),
            'edit' => Pages\EditAmcContract::route('/{record}/edit'),
        ];
    }
}
