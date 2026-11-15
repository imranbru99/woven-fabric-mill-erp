<?php

declare(strict_types=1);

namespace App\Filament\Resources\GrievanceResource\Pages;

use App\Filament\Resources\GrievanceResource;
use Filament\Resources\Pages\EditRecord;

class EditGrievance extends EditRecord
{
    protected static string $resource = GrievanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
