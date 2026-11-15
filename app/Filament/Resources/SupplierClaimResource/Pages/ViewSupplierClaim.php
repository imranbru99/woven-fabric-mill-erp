<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierClaimResource\Pages;

use App\Filament\Resources\SupplierClaimResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSupplierClaim extends ViewRecord
{
    protected static string $resource = SupplierClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
