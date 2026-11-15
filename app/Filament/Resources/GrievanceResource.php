<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\GrievanceResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Grievance;

class GrievanceResource extends MillResource
{
    protected static ?string $model = Grievance::class;

    protected static ?string $navigationGroup = 'HR & Payroll';

    protected static ?string $navigationLabel = 'Grievances';

    protected static ?int $navigationSort = 164;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrievances::route('/'),
            'create' => Pages\CreateGrievance::route('/create'),
            'view' => Pages\ViewGrievance::route('/{record}'),
            'edit' => Pages\EditGrievance::route('/{record}/edit'),
        ];
    }
}
