<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PackingMaterialResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PackingMaterial;

class PackingMaterialResource extends MillResource
{
    protected static ?string $model = PackingMaterial::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Packing Materials';

    protected static ?int $navigationSort = 43;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackingMaterials::route('/'),
            'create' => Pages\CreatePackingMaterial::route('/create'),
            'view' => Pages\ViewPackingMaterial::route('/{record}'),
            'edit' => Pages\EditPackingMaterial::route('/{record}/edit'),
        ];
    }
}
