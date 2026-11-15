<?php

declare(strict_types=1);

namespace App\Filament\Resources\HealdFrameResource\Pages;

use App\Filament\Resources\HealdFrameResource;
use Filament\Resources\Pages\ListRecords;

class ListHealdFrames extends ListRecords
{
    protected static string $resource = HealdFrameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
