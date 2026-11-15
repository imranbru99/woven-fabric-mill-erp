<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\DispatchAdviceResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\DispatchAdvice;

class DispatchAdviceResource extends MillResource
{
    protected static ?string $model = DispatchAdvice::class;

    protected static ?string $navigationGroup = 'Dispatch & Gate';

    protected static ?string $navigationLabel = 'Dispatch Advice';

    protected static ?int $navigationSort = 128;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDispatchAdvice::route('/'),
            'create' => Pages\CreateDispatchAdvice::route('/create'),
            'view' => Pages\ViewDispatchAdvice::route('/{record}'),
            'edit' => Pages\EditDispatchAdvice::route('/{record}/edit'),
        ];
    }
}
