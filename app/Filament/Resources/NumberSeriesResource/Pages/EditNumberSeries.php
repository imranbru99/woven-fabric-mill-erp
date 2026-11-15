<?php

declare(strict_types=1);

namespace App\Filament\Resources\NumberSeriesResource\Pages;

use App\Filament\Resources\NumberSeriesResource;
use Filament\Resources\Pages\EditRecord;

class EditNumberSeries extends EditRecord
{
    protected static string $resource = NumberSeriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
