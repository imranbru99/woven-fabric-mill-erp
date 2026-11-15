<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PmScheduleResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PmSchedule;

class PmScheduleResource extends MillResource
{
    protected static ?string $model = PmSchedule::class;

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'PM schedules';

    protected static ?int $navigationSort = 121;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPmSchedules::route('/'),
            'create' => Pages\CreatePmSchedule::route('/create'),
            'view' => Pages\ViewPmSchedule::route('/{record}'),
            'edit' => Pages\EditPmSchedule::route('/{record}/edit'),
        ];
    }
}
