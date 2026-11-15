<?php

declare(strict_types=1);

namespace App\Filament\Resources\HsCodeResource\Pages;

use App\Filament\Resources\HsCodeResource;
use Filament\Resources\Pages\ListRecords;

class ListHsCodes extends ListRecords
{
    protected static string $resource = HsCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
