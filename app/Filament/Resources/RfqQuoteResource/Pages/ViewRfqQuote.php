<?php

declare(strict_types=1);

namespace App\Filament\Resources\RfqQuoteResource\Pages;

use App\Filament\Resources\RfqQuoteResource;
use Filament\Resources\Pages\ViewRecord;

class ViewRfqQuote extends ViewRecord
{
    protected static string $resource = RfqQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
