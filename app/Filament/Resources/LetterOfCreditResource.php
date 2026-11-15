<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\LetterOfCreditResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\LetterOfCredit;

class LetterOfCreditResource extends MillResource
{
    protected static ?string $model = LetterOfCredit::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Letters of credit';

    protected static ?int $navigationSort = 61;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLetterOfCredits::route('/'),
            'create' => Pages\CreateLetterOfCredit::route('/create'),
            'view' => Pages\ViewLetterOfCredit::route('/{record}'),
            'edit' => Pages\EditLetterOfCredit::route('/{record}/edit'),
        ];
    }
}
