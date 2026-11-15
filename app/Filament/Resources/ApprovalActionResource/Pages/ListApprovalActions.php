<?php

declare(strict_types=1);

namespace App\Filament\Resources\ApprovalActionResource\Pages;

use App\Filament\Resources\ApprovalActionResource;
use Filament\Resources\Pages\ListRecords;

class ListApprovalActions extends ListRecords
{
    protected static string $resource = ApprovalActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
