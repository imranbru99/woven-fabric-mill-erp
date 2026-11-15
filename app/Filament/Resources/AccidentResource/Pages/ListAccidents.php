<?php

declare(strict_types=1);

namespace App\Filament\Resources\AccidentResource\Pages;

use App\Filament\Resources\AccidentResource;
use Filament\Resources\Pages\ListRecords;

class ListAccidents extends ListRecords
{
    protected static string $resource = AccidentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
