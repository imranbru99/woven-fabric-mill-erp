<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BinResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Bin;

class BinResource extends MillResource
{
    protected static ?string $model = Bin::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Bins';

    protected static ?int $navigationSort = 26;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBins::route('/'),
            'create' => Pages\CreateBin::route('/create'),
            'view' => Pages\ViewBin::route('/{record}'),
            'edit' => Pages\EditBin::route('/{record}/edit'),
        ];
    }
}
