<?php

declare(strict_types=1);

namespace App\Filament\Resources\RfqQuoteResource\Pages;

use App\Filament\Resources\RfqQuoteResource;
use Filament\Resources\Pages\ListRecords;

class ListRfqQuotes extends ListRecords
{
    protected static string $resource = RfqQuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
