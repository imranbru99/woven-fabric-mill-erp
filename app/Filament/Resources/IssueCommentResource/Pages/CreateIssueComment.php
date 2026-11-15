<?php

declare(strict_types=1);

namespace App\Filament\Resources\IssueCommentResource\Pages;

use App\Filament\Resources\IssueCommentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIssueComment extends CreateRecord
{
    protected static string $resource = IssueCommentResource::class;

}
