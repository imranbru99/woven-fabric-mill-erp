<?php

declare(strict_types=1);

namespace App\Filament\Resources\PaymentTermResource\Pages;

use App\Filament\Resources\PaymentTermResource;
use Filament\Resources\Pages\ListRecords;

class ListPaymentTerms extends ListRecords
{
    protected static string $resource = PaymentTermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
