<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FollowUpResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\FollowUp;

class FollowUpResource extends MillResource
{
    protected static ?string $model = FollowUp::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Follow Ups';

    protected static ?int $navigationSort = 51;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFollowUps::route('/'),
            'create' => Pages\CreateFollowUp::route('/create'),
            'view' => Pages\ViewFollowUp::route('/{record}'),
            'edit' => Pages\EditFollowUp::route('/{record}/edit'),
        ];
    }
}
