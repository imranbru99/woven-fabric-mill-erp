<?php

declare(strict_types=1);

namespace App\Filament\Resources\SizeRecipeItemResource\Pages;

use App\Filament\Resources\SizeRecipeItemResource;
use Filament\Resources\Pages\ViewRecord;

class ViewSizeRecipeItem extends ViewRecord
{
    protected static string $resource = SizeRecipeItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
