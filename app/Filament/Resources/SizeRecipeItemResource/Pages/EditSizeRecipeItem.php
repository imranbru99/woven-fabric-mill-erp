<?php

declare(strict_types=1);

namespace App\Filament\Resources\SizeRecipeItemResource\Pages;

use App\Filament\Resources\SizeRecipeItemResource;
use Filament\Resources\Pages\EditRecord;

class EditSizeRecipeItem extends EditRecord
{
    protected static string $resource = SizeRecipeItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
