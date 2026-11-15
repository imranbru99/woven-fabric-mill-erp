<?php

declare(strict_types=1);

namespace App\Filament\Resources\IssueRuleResource\Pages;

use App\Filament\Resources\IssueRuleResource;
use Filament\Resources\Pages\ViewRecord;

class ViewIssueRule extends ViewRecord
{
    protected static string $resource = IssueRuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
