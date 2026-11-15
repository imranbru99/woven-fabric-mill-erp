<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Payment;

class PaymentResource extends MillResource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Payments';

    protected static ?int $navigationSort = 141;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'view' => Pages\ViewPayment::route('/{record}'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
