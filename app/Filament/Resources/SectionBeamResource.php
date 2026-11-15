<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SectionBeamResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SectionBeam;

class SectionBeamResource extends MillResource
{
    protected static ?string $model = SectionBeam::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Section Beams';

    protected static ?int $navigationSort = 96;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSectionBeams::route('/'),
            'create' => Pages\CreateSectionBeam::route('/create'),
            'view' => Pages\ViewSectionBeam::route('/{record}'),
            'edit' => Pages\EditSectionBeam::route('/{record}/edit'),
        ];
    }
}
