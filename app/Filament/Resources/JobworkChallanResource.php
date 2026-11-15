<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\JobworkChallanResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\JobworkChallan;

class JobworkChallanResource extends MillResource
{
    protected static ?string $model = JobworkChallan::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Jobwork Challans';

    protected static ?int $navigationSort = 110;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobworkChallans::route('/'),
            'create' => Pages\CreateJobworkChallan::route('/create'),
            'view' => Pages\ViewJobworkChallan::route('/{record}'),
            'edit' => Pages\EditJobworkChallan::route('/{record}/edit'),
        ];
    }
}
