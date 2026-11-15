<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PmTaskResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PmTask;

class PmTaskResource extends MillResource
{
    protected static ?string $model = PmTask::class;

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'Pm Tasks';

    protected static ?int $navigationSort = 122;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPmTasks::route('/'),
            'create' => Pages\CreatePmTask::route('/create'),
            'view' => Pages\ViewPmTask::route('/{record}'),
            'edit' => Pages\EditPmTask::route('/{record}/edit'),
        ];
    }
}
