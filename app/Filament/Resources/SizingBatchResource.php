<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SizingBatchResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SizingBatch;

class SizingBatchResource extends MillResource
{
    protected static ?string $model = SizingBatch::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Sizing Batches';

    protected static ?int $navigationSort = 97;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSizingBatches::route('/'),
            'create' => Pages\CreateSizingBatch::route('/create'),
            'view' => Pages\ViewSizingBatch::route('/{record}'),
            'edit' => Pages\EditSizingBatch::route('/{record}/edit'),
        ];
    }
}
