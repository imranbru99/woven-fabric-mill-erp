<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\JobCardResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\JobCard;

class JobCardResource extends MillResource
{
    protected static ?string $model = JobCard::class;

    protected static ?string $navigationGroup = 'Planning';

    protected static ?string $navigationLabel = 'Job Cards';

    protected static ?int $navigationSort = 93;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobCards::route('/'),
            'create' => Pages\CreateJobCard::route('/create'),
            'view' => Pages\ViewJobCard::route('/{record}'),
            'edit' => Pages\EditJobCard::route('/{record}/edit'),
        ];
    }
}
