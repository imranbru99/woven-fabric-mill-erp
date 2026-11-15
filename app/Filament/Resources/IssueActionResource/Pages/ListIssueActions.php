<?php

declare(strict_types=1);

namespace App\Filament\Resources\IssueActionResource\Pages;

use App\Filament\Resources\IssueActionResource;
use Filament\Resources\Pages\ListRecords;

class ListIssueActions extends ListRecords
{
    protected static string $resource = IssueActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
