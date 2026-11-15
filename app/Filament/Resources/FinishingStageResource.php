<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FinishingStageResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\FinishingStage;

class FinishingStageResource extends MillResource
{
    protected static ?string $model = FinishingStage::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Finishing Stages';

    protected static ?int $navigationSort = 109;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFinishingStages::route('/'),
            'create' => Pages\CreateFinishingStage::route('/create'),
            'view' => Pages\ViewFinishingStage::route('/{record}'),
            'edit' => Pages\EditFinishingStage::route('/{record}/edit'),
        ];
    }
}
