<?php

declare(strict_types=1);

namespace App\Filament\Resources\ApprovalLimitResource\Pages;

use App\Filament\Resources\ApprovalLimitResource;
use Filament\Resources\Pages\EditRecord;

class EditApprovalLimit extends EditRecord
{
    protected static string $resource = ApprovalLimitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
