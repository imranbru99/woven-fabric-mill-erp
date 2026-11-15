<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SampleResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Sample;

class SampleResource extends MillResource
{
    protected static ?string $model = Sample::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Samples';

    protected static ?int $navigationSort = 53;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSamples::route('/'),
            'create' => Pages\CreateSample::route('/create'),
            'view' => Pages\ViewSample::route('/{record}'),
            'edit' => Pages\EditSample::route('/{record}/edit'),
        ];
    }
}
