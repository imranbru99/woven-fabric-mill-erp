<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BomLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\BomLine;

class BomLineResource extends MillResource
{
    protected static ?string $model = BomLine::class;

    protected static ?string $navigationGroup = 'Planning';

    protected static ?string $navigationLabel = 'Bom Lines';

    protected static ?int $navigationSort = 88;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBomLines::route('/'),
            'create' => Pages\CreateBomLine::route('/create'),
            'view' => Pages\ViewBomLine::route('/{record}'),
            'edit' => Pages\EditBomLine::route('/{record}/edit'),
        ];
    }
}
