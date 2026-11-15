<?php

declare(strict_types=1);

namespace App\Filament\Resources\SizeRecipeResource\Pages;

use App\Filament\Resources\SizeRecipeResource;
use Filament\Resources\Pages\ListRecords;

class ListSizeRecipes extends ListRecords
{
    protected static string $resource = SizeRecipeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
