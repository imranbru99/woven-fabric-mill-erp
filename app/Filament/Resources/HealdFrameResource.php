<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\HealdFrameResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\HealdFrame;

class HealdFrameResource extends MillResource
{
    protected static ?string $model = HealdFrame::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Heald Frames';

    protected static ?int $navigationSort = 102;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHealdFrames::route('/'),
            'create' => Pages\CreateHealdFrame::route('/create'),
            'view' => Pages\ViewHealdFrame::route('/{record}'),
            'edit' => Pages\EditHealdFrame::route('/{record}/edit'),
        ];
    }
}
