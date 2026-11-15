<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SampleRequestResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SampleRequest;

class SampleRequestResource extends MillResource
{
    protected static ?string $model = SampleRequest::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Sample Requests';

    protected static ?int $navigationSort = 52;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSampleRequests::route('/'),
            'create' => Pages\CreateSampleRequest::route('/create'),
            'view' => Pages\ViewSampleRequest::route('/{record}'),
            'edit' => Pages\EditSampleRequest::route('/{record}/edit'),
        ];
    }
}
