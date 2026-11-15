<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProductionPlanResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\ProductionPlan;

class ProductionPlanResource extends MillResource
{
    protected static ?string $model = ProductionPlan::class;

    protected static ?string $navigationGroup = 'Planning';

    protected static ?string $navigationLabel = 'Production Plans';

    protected static ?int $navigationSort = 89;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductionPlans::route('/'),
            'create' => Pages\CreateProductionPlan::route('/create'),
            'view' => Pages\ViewProductionPlan::route('/{record}'),
            'edit' => Pages\EditProductionPlan::route('/{record}/edit'),
        ];
    }
}
