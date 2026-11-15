<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\LoomAllocationResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\LoomAllocation;

class LoomAllocationResource extends MillResource
{
    protected static ?string $model = LoomAllocation::class;

    protected static ?string $navigationGroup = 'Planning';

    protected static ?string $navigationLabel = 'Loom Allocations';

    protected static ?int $navigationSort = 92;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoomAllocations::route('/'),
            'create' => Pages\CreateLoomAllocation::route('/create'),
            'view' => Pages\ViewLoomAllocation::route('/{record}'),
            'edit' => Pages\EditLoomAllocation::route('/{record}/edit'),
        ];
    }
}
