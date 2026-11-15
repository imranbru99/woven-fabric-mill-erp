<?php

declare(strict_types=1);

namespace App\Filament\Resources\ApprovalStepResource\Pages;

use App\Filament\Resources\ApprovalStepResource;
use Filament\Resources\Pages\ListRecords;

class ListApprovalSteps extends ListRecords
{
    protected static string $resource = ApprovalStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
