<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\QuotationLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\QuotationLine;

class QuotationLineResource extends MillResource
{
    protected static ?string $model = QuotationLine::class;

    protected static ?string $navigationGroup = 'Marketing & Sales';

    protected static ?string $navigationLabel = 'Quotation Lines';

    protected static ?int $navigationSort = 57;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuotationLines::route('/'),
            'create' => Pages\CreateQuotationLine::route('/create'),
            'view' => Pages\ViewQuotationLine::route('/{record}'),
            'edit' => Pages\EditQuotationLine::route('/{record}/edit'),
        ];
    }
}
