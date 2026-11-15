<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\IssueActionResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\IssueAction;

class IssueActionResource extends MillResource
{
    protected static ?string $model = IssueAction::class;

    protected static ?string $navigationGroup = 'Issues';

    protected static ?string $navigationLabel = 'Issue Actions';

    protected static ?int $navigationSort = 168;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIssueActions::route('/'),
            'create' => Pages\CreateIssueAction::route('/create'),
            'view' => Pages\ViewIssueAction::route('/{record}'),
            'edit' => Pages\EditIssueAction::route('/{record}/edit'),
        ];
    }
}
