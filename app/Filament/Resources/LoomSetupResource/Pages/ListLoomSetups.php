<?php

declare(strict_types=1);

namespace App\Filament\Resources\LoomSetupResource\Pages;

use App\Filament\Resources\LoomSetupResource;
use Filament\Resources\Pages\ListRecords;

class ListLoomSetups extends ListRecords
{
    protected static string $resource = LoomSetupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
