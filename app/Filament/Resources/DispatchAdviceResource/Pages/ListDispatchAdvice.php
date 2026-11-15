<?php

declare(strict_types=1);

namespace App\Filament\Resources\DispatchAdviceResource\Pages;

use App\Filament\Resources\DispatchAdviceResource;
use Filament\Resources\Pages\ListRecords;

class ListDispatchAdvice extends ListRecords
{
    protected static string $resource = DispatchAdviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}
