<?php

declare(strict_types=1);

namespace App\Filament\Resources\DefectResource\Pages;

use App\Filament\Resources\DefectResource;
use Filament\Resources\Pages\ListRecords;

class ListDefects extends ListRecords
{
    protected static string $resource = DefectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
