<?php

declare(strict_types=1);

namespace App\Filament\Resources\UomConversionResource\Pages;

use App\Filament\Resources\UomConversionResource;
use Filament\Resources\Pages\ListRecords;

class ListUomConversions extends ListRecords
{
    protected static string $resource = UomConversionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
