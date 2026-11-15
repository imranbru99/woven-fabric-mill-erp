<?php

declare(strict_types=1);

namespace App\Filament\Resources\ApprovalLimitResource\Pages;

use App\Filament\Resources\ApprovalLimitResource;
use Filament\Resources\Pages\ViewRecord;

class ViewApprovalLimit extends ViewRecord
{
    protected static string $resource = ApprovalLimitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
