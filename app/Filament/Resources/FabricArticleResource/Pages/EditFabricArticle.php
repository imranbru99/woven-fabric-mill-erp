<?php

declare(strict_types=1);

namespace App\Filament\Resources\FabricArticleResource\Pages;

use App\Filament\Resources\FabricArticleResource;
use Filament\Resources\Pages\EditRecord;

class EditFabricArticle extends EditRecord
{
    protected static string $resource = FabricArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
