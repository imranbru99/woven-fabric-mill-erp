<?php

declare(strict_types=1);

namespace App\Filament\Resources\ApprovalFlowResource\Pages;

use App\Filament\Resources\ApprovalFlowResource;
use Filament\Resources\Pages\EditRecord;

class EditApprovalFlow extends EditRecord
{
    protected static string $resource = ApprovalFlowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
