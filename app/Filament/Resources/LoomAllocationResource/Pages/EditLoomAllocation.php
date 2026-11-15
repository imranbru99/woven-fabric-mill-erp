<?php

declare(strict_types=1);

namespace App\Filament\Resources\LoomAllocationResource\Pages;

use App\Filament\Resources\LoomAllocationResource;
use Filament\Resources\Pages\EditRecord;

class EditLoomAllocation extends EditRecord
{
    protected static string $resource = LoomAllocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
