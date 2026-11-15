<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\IssueResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Issue;

class IssueResource extends MillResource
{
    protected static ?string $model = Issue::class;

    protected static ?string $navigationGroup = 'Issues';

    protected static ?string $navigationLabel = 'Issues';

    protected static ?int $navigationSort = 166;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIssues::route('/'),
            'create' => Pages\CreateIssue::route('/create'),
            'view' => Pages\ViewIssue::route('/{record}'),
            'edit' => Pages\EditIssue::route('/{record}/edit'),
        ];
    }
}
