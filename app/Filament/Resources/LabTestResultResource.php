<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\LabTestResultResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\LabTestResult;

class LabTestResultResource extends MillResource
{
    protected static ?string $model = LabTestResult::class;

    protected static ?string $navigationGroup = 'Quality';

    protected static ?string $navigationLabel = 'Lab Test Results';

    protected static ?int $navigationSort = 118;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLabTestResults::route('/'),
            'create' => Pages\CreateLabTestResult::route('/create'),
            'view' => Pages\ViewLabTestResult::route('/{record}'),
            'edit' => Pages\EditLabTestResult::route('/{record}/edit'),
        ];
    }
}
