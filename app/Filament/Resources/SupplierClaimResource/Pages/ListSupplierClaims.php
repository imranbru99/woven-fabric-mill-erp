<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierClaimResource\Pages;

use App\Filament\Resources\SupplierClaimResource;
use Filament\Resources\Pages\ListRecords;

class ListSupplierClaims extends ListRecords
{
    protected static string $resource = SupplierClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
