<?php

declare(strict_types=1);

namespace App\Filament\Resources\BuyerClaimResource\Pages;

use App\Filament\Resources\BuyerClaimResource;
use Filament\Resources\Pages\ViewRecord;

class ViewBuyerClaim extends ViewRecord
{
    protected static string $resource = BuyerClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
