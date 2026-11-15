<?php

declare(strict_types=1);

namespace App\Filament\Resources\FabricArticleResource\Pages;

use App\Filament\Resources\FabricArticleResource;
use Filament\Resources\Pages\ViewRecord;

class ViewFabricArticle extends ViewRecord
{
    protected static string $resource = FabricArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
