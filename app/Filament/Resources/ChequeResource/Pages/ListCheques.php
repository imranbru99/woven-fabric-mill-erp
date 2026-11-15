<?php

declare(strict_types=1);

namespace App\Filament\Resources\ChequeResource\Pages;

use App\Filament\Resources\ChequeResource;
use Filament\Resources\Pages\ListRecords;

class ListCheques extends ListRecords
{
    protected static string $resource = ChequeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
