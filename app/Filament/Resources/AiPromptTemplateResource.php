<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\AiPromptTemplateResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\AiPromptTemplate;

class AiPromptTemplateResource extends MillResource
{
    protected static ?string $model = AiPromptTemplate::class;

    protected static ?string $navigationGroup = 'Issues';

    protected static ?string $navigationLabel = 'AI prompt templates';

    protected static ?int $navigationSort = 169;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAiPromptTemplates::route('/'),
            'create' => Pages\CreateAiPromptTemplate::route('/create'),
            'view' => Pages\ViewAiPromptTemplate::route('/{record}'),
            'edit' => Pages\EditAiPromptTemplate::route('/{record}/edit'),
        ];
    }
}
