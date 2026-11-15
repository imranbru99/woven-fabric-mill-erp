<?php

declare(strict_types=1);

namespace App\Filament\Resources\BudgetLineResource\Pages;

use App\Filament\Resources\BudgetLineResource;
use Filament\Resources\Pages\EditRecord;

class EditBudgetLine extends EditRecord
{
    protected static string $resource = BudgetLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
