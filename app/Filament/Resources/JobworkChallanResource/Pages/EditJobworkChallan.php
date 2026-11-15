<?php

declare(strict_types=1);

namespace App\Filament\Resources\JobworkChallanResource\Pages;

use App\Filament\Resources\JobworkChallanResource;
use Filament\Resources\Pages\EditRecord;

class EditJobworkChallan extends EditRecord
{
    protected static string $resource = JobworkChallanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
