<?php

declare(strict_types=1);

namespace App\Filament\Resources\QuotationLineResource\Pages;

use App\Filament\Resources\QuotationLineResource;
use Filament\Resources\Pages\ListRecords;

class ListQuotationLines extends ListRecords
{
    protected static string $resource = QuotationLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
