<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\LabTestResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\LabTest;

class LabTestResource extends MillResource
{
    protected static ?string $model = LabTest::class;

    protected static ?string $navigationGroup = 'Quality';

    protected static ?string $navigationLabel = 'Lab Tests';

    protected static ?int $navigationSort = 117;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLabTests::route('/'),
            'create' => Pages\CreateLabTest::route('/create'),
            'view' => Pages\ViewLabTest::route('/{record}'),
            'edit' => Pages\EditLabTest::route('/{record}/edit'),
        ];
    }
}
