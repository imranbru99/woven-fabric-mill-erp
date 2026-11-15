<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\DrawingJobResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\DrawingJob;

class DrawingJobResource extends MillResource
{
    protected static ?string $model = DrawingJob::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Drawing Jobs';

    protected static ?int $navigationSort = 100;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDrawingJobs::route('/'),
            'create' => Pages\CreateDrawingJob::route('/create'),
            'view' => Pages\ViewDrawingJob::route('/{record}'),
            'edit' => Pages\EditDrawingJob::route('/{record}/edit'),
        ];
    }
}
