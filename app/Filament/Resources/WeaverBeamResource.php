<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\WeaverBeamResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\WeaverBeam;

class WeaverBeamResource extends MillResource
{
    protected static ?string $model = WeaverBeam::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Weaver Beams';

    protected static ?int $navigationSort = 99;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWeaverBeams::route('/'),
            'create' => Pages\CreateWeaverBeam::route('/create'),
            'view' => Pages\ViewWeaverBeam::route('/{record}'),
            'edit' => Pages\EditWeaverBeam::route('/{record}/edit'),
        ];
    }
}
