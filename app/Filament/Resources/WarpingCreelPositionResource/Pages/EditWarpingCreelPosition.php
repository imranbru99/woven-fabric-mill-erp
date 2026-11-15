<?php

declare(strict_types=1);

namespace App\Filament\Resources\WarpingCreelPositionResource\Pages;

use App\Filament\Resources\WarpingCreelPositionResource;
use Filament\Resources\Pages\EditRecord;

class EditWarpingCreelPosition extends EditRecord
{
    protected static string $resource = WarpingCreelPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
