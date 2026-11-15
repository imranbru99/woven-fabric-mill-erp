<?php

declare(strict_types=1);

namespace App\Filament\Resources\IssueActionResource\Pages;

use App\Filament\Resources\IssueActionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateIssueAction extends CreateRecord
{
    protected static string $resource = IssueActionResource::class;

}
