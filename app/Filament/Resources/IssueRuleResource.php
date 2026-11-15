<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\IssueRuleResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\IssueRule;

class IssueRuleResource extends MillResource
{
    protected static ?string $model = IssueRule::class;

    protected static ?string $navigationGroup = 'Issues';

    protected static ?string $navigationLabel = 'Issue Rules';

    protected static ?int $navigationSort = 165;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIssueRules::route('/'),
            'create' => Pages\CreateIssueRule::route('/create'),
            'view' => Pages\ViewIssueRule::route('/{record}'),
            'edit' => Pages\EditIssueRule::route('/{record}/edit'),
        ];
    }
}
