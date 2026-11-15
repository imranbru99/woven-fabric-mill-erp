<?php

declare(strict_types=1);

namespace App\Filament\Resources\BuyerClaimResource\Pages;

use App\Filament\Resources\BuyerClaimResource;
use Filament\Resources\Pages\EditRecord;

class EditBuyerClaim extends EditRecord
{
    protected static string $resource = BuyerClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
