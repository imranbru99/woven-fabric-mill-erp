<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\FinishingBatchResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\FinishingBatch;

class FinishingBatchResource extends MillResource
{
    protected static ?string $model = FinishingBatch::class;

    protected static ?string $navigationGroup = 'Production';

    protected static ?string $navigationLabel = 'Finishing Batches';

    protected static ?int $navigationSort = 108;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFinishingBatches::route('/'),
            'create' => Pages\CreateFinishingBatch::route('/create'),
            'view' => Pages\ViewFinishingBatch::route('/{record}'),
            'edit' => Pages\EditFinishingBatch::route('/{record}/edit'),
        ];
    }
}
