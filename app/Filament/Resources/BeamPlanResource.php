<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BeamPlanResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\BeamPlan;

class BeamPlanResource extends MillResource
{
    protected static ?string $model = BeamPlan::class;

    protected static ?string $navigationGroup = 'Planning';

    protected static ?string $navigationLabel = 'Beam Plans';

    protected static ?int $navigationSort = 91;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBeamPlans::route('/'),
            'create' => Pages\CreateBeamPlan::route('/create'),
            'view' => Pages\ViewBeamPlan::route('/{record}'),
            'edit' => Pages\EditBeamPlan::route('/{record}/edit'),
        ];
    }
}
