<?php

declare(strict_types=1);

namespace App\Filament\Resources\ChequeResource\Pages;

use App\Filament\Resources\ChequeResource;
use Filament\Resources\Pages\ViewRecord;

class ViewCheque extends ViewRecord
{
    protected static string $resource = ChequeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
