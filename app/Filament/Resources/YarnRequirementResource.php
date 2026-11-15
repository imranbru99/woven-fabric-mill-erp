<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\YarnRequirementResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\YarnRequirement;

class YarnRequirementResource extends MillResource
{
    protected static ?string $model = YarnRequirement::class;

    protected static ?string $navigationGroup = 'Planning';

    protected static ?string $navigationLabel = 'Yarn Requirements';

    protected static ?int $navigationSort = 90;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListYarnRequirements::route('/'),
            'create' => Pages\CreateYarnRequirement::route('/create'),
            'view' => Pages\ViewYarnRequirement::route('/{record}'),
            'edit' => Pages\EditYarnRequirement::route('/{record}/edit'),
        ];
    }
}
