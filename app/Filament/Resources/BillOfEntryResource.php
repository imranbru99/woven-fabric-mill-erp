<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BillOfEntryResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\BillOfEntry;

class BillOfEntryResource extends MillResource
{
    protected static ?string $model = BillOfEntry::class;

    protected static ?string $navigationGroup = 'Procurement';

    protected static ?string $navigationLabel = 'Bills of entry';

    protected static ?int $navigationSort = 74;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBillOfEntries::route('/'),
            'create' => Pages\CreateBillOfEntry::route('/create'),
            'view' => Pages\ViewBillOfEntry::route('/{record}'),
            'edit' => Pages\EditBillOfEntry::route('/{record}/edit'),
        ];
    }
}
