<?php

declare(strict_types=1);

namespace App\Filament\Resources\DepreciationResource\Pages;

use App\Filament\Resources\DepreciationResource;
use Filament\Resources\Pages\ListRecords;

class ListDepreciations extends ListRecords
{
    protected static string $resource = DepreciationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
