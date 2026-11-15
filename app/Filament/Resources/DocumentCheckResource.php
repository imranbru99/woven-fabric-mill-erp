<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\DocumentCheckResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\DocumentCheck;

class DocumentCheckResource extends MillResource
{
    protected static ?string $model = DocumentCheck::class;

    protected static ?string $navigationGroup = 'Dispatch & Gate';

    protected static ?string $navigationLabel = 'Document Checks';

    protected static ?int $navigationSort = 132;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocumentChecks::route('/'),
            'create' => Pages\CreateDocumentCheck::route('/create'),
            'view' => Pages\ViewDocumentCheck::route('/{record}'),
            'edit' => Pages\EditDocumentCheck::route('/{record}/edit'),
        ];
    }
}
