<?php

declare(strict_types=1);

namespace App\Filament\Resources\IncotermResource\Pages;

use App\Filament\Resources\IncotermResource;
use Filament\Resources\Pages\ListRecords;

class ListIncoterms extends ListRecords
{
    protected static string $resource = IncotermResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
