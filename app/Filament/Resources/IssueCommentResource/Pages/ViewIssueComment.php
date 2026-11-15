<?php

declare(strict_types=1);

namespace App\Filament\Resources\IssueCommentResource\Pages;

use App\Filament\Resources\IssueCommentResource;
use Filament\Resources\Pages\ViewRecord;

class ViewIssueComment extends ViewRecord
{
    protected static string $resource = IssueCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
