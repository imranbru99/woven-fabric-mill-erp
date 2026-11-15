<?php

declare(strict_types=1);

namespace App\Filament\Resources\ApprovalActionResource\Pages;

use App\Filament\Resources\ApprovalActionResource;
use Filament\Resources\Pages\ViewRecord;

class ViewApprovalAction extends ViewRecord
{
    protected static string $resource = ApprovalActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
