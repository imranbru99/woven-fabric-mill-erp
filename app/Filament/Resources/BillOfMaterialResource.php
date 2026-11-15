<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BillOfMaterialResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\BillOfMaterial;

class BillOfMaterialResource extends MillResource
{
    protected static ?string $model = BillOfMaterial::class;

    protected static ?string $navigationGroup = 'Planning';

    protected static ?string $navigationLabel = 'Bills of material';

    protected static ?int $navigationSort = 87;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBillOfMaterials::route('/'),
            'create' => Pages\CreateBillOfMaterial::route('/create'),
            'view' => Pages\ViewBillOfMaterial::route('/{record}'),
            'edit' => Pages\EditBillOfMaterial::route('/{record}/edit'),
        ];
    }
}
