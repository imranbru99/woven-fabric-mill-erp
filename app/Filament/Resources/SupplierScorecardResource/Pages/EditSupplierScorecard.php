<?php

declare(strict_types=1);

namespace App\Filament\Resources\SupplierScorecardResource\Pages;

use App\Filament\Resources\SupplierScorecardResource;
use Filament\Resources\Pages\EditRecord;

class EditSupplierScorecard extends EditRecord
{
    protected static string $resource = SupplierScorecardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
