<?php

declare(strict_types=1);

namespace App\Filament\Resources\IssueRuleResource\Pages;

use App\Filament\Resources\IssueRuleResource;
use Filament\Resources\Pages\EditRecord;

class EditIssueRule extends EditRecord
{
    protected static string $resource = IssueRuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
