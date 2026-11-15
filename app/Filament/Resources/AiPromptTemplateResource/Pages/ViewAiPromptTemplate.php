<?php

declare(strict_types=1);

namespace App\Filament\Resources\AiPromptTemplateResource\Pages;

use App\Filament\Resources\AiPromptTemplateResource;
use Filament\Resources\Pages\ViewRecord;

class ViewAiPromptTemplate extends ViewRecord
{
    protected static string $resource = AiPromptTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
