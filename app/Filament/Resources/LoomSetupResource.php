<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\LoomSetupResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\LoomSetup;

class LoomSetupResource extends MillResource
{
    protected static ?string $model = LoomSetup::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Loom Setups';

    protected static ?int $navigationSort = 103;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoomSetups::route('/'),
            'create' => Pages\CreateLoomSetup::route('/create'),
            'view' => Pages\ViewLoomSetup::route('/{record}'),
            'edit' => Pages\EditLoomSetup::route('/{record}/edit'),
        ];
    }
}
