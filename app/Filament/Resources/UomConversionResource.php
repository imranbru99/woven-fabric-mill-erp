<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\UomConversionResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\UomConversion;

class UomConversionResource extends MillResource
{
    protected static ?string $model = UomConversion::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'UoM conversions';

    protected static ?int $navigationSort = 28;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUomConversions::route('/'),
            'create' => Pages\CreateUomConversion::route('/create'),
            'view' => Pages\ViewUomConversion::route('/{record}'),
            'edit' => Pages\EditUomConversion::route('/{record}/edit'),
        ];
    }
}
