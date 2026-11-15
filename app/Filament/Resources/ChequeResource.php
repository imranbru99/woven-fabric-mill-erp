<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ChequeResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Cheque;

class ChequeResource extends MillResource
{
    protected static ?string $model = Cheque::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Cheques';

    protected static ?int $navigationSort = 144;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCheques::route('/'),
            'create' => Pages\CreateCheque::route('/create'),
            'view' => Pages\ViewCheque::route('/{record}'),
            'edit' => Pages\EditCheque::route('/{record}/edit'),
        ];
    }
}
