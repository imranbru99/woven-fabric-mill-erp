<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\WorkOrderSpareResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\WorkOrderSpare;

class WorkOrderSpareResource extends MillResource
{
    protected static ?string $model = WorkOrderSpare::class;

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'Work Order Spares';

    protected static ?int $navigationSort = 124;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkOrderSpares::route('/'),
            'create' => Pages\CreateWorkOrderSpare::route('/create'),
            'view' => Pages\ViewWorkOrderSpare::route('/{record}'),
            'edit' => Pages\EditWorkOrderSpare::route('/{record}/edit'),
        ];
    }
}
