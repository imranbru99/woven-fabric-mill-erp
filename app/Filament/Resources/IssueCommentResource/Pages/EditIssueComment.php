<?php

declare(strict_types=1);

namespace App\Filament\Resources\IssueCommentResource\Pages;

use App\Filament\Resources\IssueCommentResource;
use Filament\Resources\Pages\EditRecord;

class EditIssueComment extends EditRecord
{
    protected static string $resource = IssueCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
