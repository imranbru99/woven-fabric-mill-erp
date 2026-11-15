<?php

declare(strict_types=1);

namespace App\Filament\Resources\RfqLineResource\Pages;

use App\Filament\Resources\RfqLineResource;
use Filament\Resources\Pages\ListRecords;

class ListRfqLines extends ListRecords
{
    protected static string $resource = RfqLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
