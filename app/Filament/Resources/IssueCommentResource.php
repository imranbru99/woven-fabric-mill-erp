<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\IssueCommentResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\IssueComment;

class IssueCommentResource extends MillResource
{
    protected static ?string $model = IssueComment::class;

    protected static ?string $navigationGroup = 'Issues';

    protected static ?string $navigationLabel = 'Issue Comments';

    protected static ?int $navigationSort = 167;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIssueComments::route('/'),
            'create' => Pages\CreateIssueComment::route('/create'),
            'view' => Pages\ViewIssueComment::route('/{record}'),
            'edit' => Pages\EditIssueComment::route('/{record}/edit'),
        ];
    }
}
