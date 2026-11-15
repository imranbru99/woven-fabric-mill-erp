<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\DefectResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Defect;

class DefectResource extends MillResource
{
    protected static ?string $model = Defect::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Defects';

    protected static ?int $navigationSort = 45;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDefects::route('/'),
            'create' => Pages\CreateDefect::route('/create'),
            'view' => Pages\ViewDefect::route('/{record}'),
            'edit' => Pages\EditDefect::route('/{record}/edit'),
        ];
    }
}
