<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\JobworkChallanLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\JobworkChallanLine;

class JobworkChallanLineResource extends MillResource
{
    protected static ?string $model = JobworkChallanLine::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Jobwork Challan Lines';

    protected static ?int $navigationSort = 111;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobworkChallanLines::route('/'),
            'create' => Pages\CreateJobworkChallanLine::route('/create'),
            'view' => Pages\ViewJobworkChallanLine::route('/{record}'),
            'edit' => Pages\EditJobworkChallanLine::route('/{record}/edit'),
        ];
    }
}
