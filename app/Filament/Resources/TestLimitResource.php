<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\TestLimitResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\TestLimit;

class TestLimitResource extends MillResource
{
    protected static ?string $model = TestLimit::class;

    protected static ?string $navigationGroup = 'Quality';

    protected static ?string $navigationLabel = 'Test Limits';

    protected static ?int $navigationSort = 115;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestLimits::route('/'),
            'create' => Pages\CreateTestLimit::route('/create'),
            'view' => Pages\ViewTestLimit::route('/{record}'),
            'edit' => Pages\EditTestLimit::route('/{record}/edit'),
        ];
    }
}
