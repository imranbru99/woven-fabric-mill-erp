<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentTermResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PaymentTerm;

class PaymentTermResource extends MillResource
{
    protected static ?string $model = PaymentTerm::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Payment Terms';

    protected static ?int $navigationSort = 33;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentTerms::route('/'),
            'create' => Pages\CreatePaymentTerm::route('/create'),
            'view' => Pages\ViewPaymentTerm::route('/{record}'),
            'edit' => Pages\EditPaymentTerm::route('/{record}/edit'),
        ];
    }
}
