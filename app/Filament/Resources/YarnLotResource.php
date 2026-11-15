<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\YarnLotResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\YarnLot;

class YarnLotResource extends MillResource
{
    protected static ?string $model = YarnLot::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Yarn Lots';

    protected static ?int $navigationSort = 37;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListYarnLots::route('/'),
            'create' => Pages\CreateYarnLot::route('/create'),
            'view' => Pages\ViewYarnLot::route('/{record}'),
            'edit' => Pages\EditYarnLot::route('/{record}/edit'),
        ];
    }
}
