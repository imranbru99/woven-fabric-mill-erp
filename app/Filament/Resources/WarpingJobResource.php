<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\WarpingJobResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\WarpingJob;

class WarpingJobResource extends MillResource
{
    protected static ?string $model = WarpingJob::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Warping Jobs';

    protected static ?int $navigationSort = 94;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWarpingJobs::route('/'),
            'create' => Pages\CreateWarpingJob::route('/create'),
            'view' => Pages\ViewWarpingJob::route('/{record}'),
            'edit' => Pages\EditWarpingJob::route('/{record}/edit'),
        ];
    }
}
