<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseRequisitionLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PurchaseRequisitionLine;

class PurchaseRequisitionLineResource extends MillResource
{
    protected static ?string $model = PurchaseRequisitionLine::class;

    protected static ?string $navigationGroup = 'Procurement';

    protected static ?string $navigationLabel = 'Purchase Requisition Lines';

    protected static ?int $navigationSort = 67;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPurchaseRequisitionLines::route('/'),
            'create' => Pages\CreatePurchaseRequisitionLine::route('/create'),
            'view' => Pages\ViewPurchaseRequisitionLine::route('/{record}'),
            'edit' => Pages\EditPurchaseRequisitionLine::route('/{record}/edit'),
        ];
    }
}
