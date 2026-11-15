<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RequestForQuotationResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\RequestForQuotation;

class RequestForQuotationResource extends MillResource
{
    protected static ?string $model = RequestForQuotation::class;

    protected static ?string $navigationGroup = 'Procurement';

    protected static ?string $navigationLabel = 'RFQs';

    protected static ?int $navigationSort = 68;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequestForQuotations::route('/'),
            'create' => Pages\CreateRequestForQuotation::route('/create'),
            'view' => Pages\ViewRequestForQuotation::route('/{record}'),
            'edit' => Pages\EditRequestForQuotation::route('/{record}/edit'),
        ];
    }
}
