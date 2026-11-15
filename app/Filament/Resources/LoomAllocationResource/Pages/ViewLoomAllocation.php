<?php

declare(strict_types=1);

namespace App\Filament\Resources\LoomAllocationResource\Pages;

use App\Filament\Resources\LoomAllocationResource;
use Filament\Resources\Pages\ViewRecord;

class ViewLoomAllocation extends ViewRecord
{
    protected static string $resource = LoomAllocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
