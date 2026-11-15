<?php

declare(strict_types=1);

namespace App\Filament\Resources\ApprovalStepResource\Pages;

use App\Filament\Resources\ApprovalStepResource;
use Filament\Resources\Pages\ViewRecord;

class ViewApprovalStep extends ViewRecord
{
    protected static string $resource = ApprovalStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
