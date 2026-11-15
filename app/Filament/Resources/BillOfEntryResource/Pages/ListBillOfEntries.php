<?php

declare(strict_types=1);

namespace App\Filament\Resources\BillOfEntryResource\Pages;

use App\Filament\Resources\BillOfEntryResource;
use Filament\Resources\Pages\ListRecords;

class ListBillOfEntries extends ListRecords
{
    protected static string $resource = BillOfEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
