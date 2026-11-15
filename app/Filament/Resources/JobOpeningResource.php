<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\JobOpeningResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\JobOpening;

class JobOpeningResource extends MillResource
{
    protected static ?string $model = JobOpening::class;

    protected static ?string $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Job Openings';

    protected static ?int $navigationSort = 173;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobOpenings::route('/'),
            'create' => Pages\CreateJobOpening::route('/create'),
            'view' => Pages\ViewJobOpening::route('/{record}'),
            'edit' => Pages\EditJobOpening::route('/{record}/edit'),
        ];
    }
}
