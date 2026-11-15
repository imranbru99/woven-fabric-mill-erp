<?php

declare(strict_types=1);

namespace App\Filament\Resources\PriceListLineResource\Pages;

use App\Filament\Resources\PriceListLineResource;
use Filament\Resources\Pages\ListRecords;

class ListPriceListLines extends ListRecords
{
    protected static string $resource = PriceListLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
