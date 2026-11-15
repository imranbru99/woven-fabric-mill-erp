<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\TestPackageResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\TestPackage;

class TestPackageResource extends MillResource
{
    protected static ?string $model = TestPackage::class;

    protected static ?string $navigationGroup = 'Quality';

    protected static ?string $navigationLabel = 'Test Packages';

    protected static ?int $navigationSort = 114;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestPackages::route('/'),
            'create' => Pages\CreateTestPackage::route('/create'),
            'view' => Pages\ViewTestPackage::route('/{record}'),
            'edit' => Pages\EditTestPackage::route('/{record}/edit'),
        ];
    }
}
