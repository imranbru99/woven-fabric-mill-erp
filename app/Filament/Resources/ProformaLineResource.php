<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ProformaLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\ProformaLine;

class ProformaLineResource extends MillResource
{
    protected static ?string $model = ProformaLine::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Proforma Lines';

    protected static ?int $navigationSort = 59;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProformaLines::route('/'),
            'create' => Pages\CreateProformaLine::route('/create'),
            'view' => Pages\ViewProformaLine::route('/{record}'),
            'edit' => Pages\EditProformaLine::route('/{record}/edit'),
        ];
    }
}
