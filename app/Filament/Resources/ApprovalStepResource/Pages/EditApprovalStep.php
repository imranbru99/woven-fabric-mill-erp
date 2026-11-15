<?php

declare(strict_types=1);

namespace App\Filament\Resources\ApprovalStepResource\Pages;

use App\Filament\Resources\ApprovalStepResource;
use Filament\Resources\Pages\EditRecord;

class EditApprovalStep extends EditRecord
{
    protected static string $resource = ApprovalStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
