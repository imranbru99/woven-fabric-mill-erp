<?php

declare(strict_types=1);

namespace App\Filament\Resources\TaxRuleResource\Pages;

use App\Filament\Resources\TaxRuleResource;
use Filament\Resources\Pages\EditRecord;

class EditTaxRule extends EditRecord
{
    protected static string $resource = TaxRuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
