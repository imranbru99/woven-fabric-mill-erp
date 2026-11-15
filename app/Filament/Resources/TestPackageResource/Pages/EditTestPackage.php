<?php

declare(strict_types=1);

namespace App\Filament\Resources\TestPackageResource\Pages;

use App\Filament\Resources\TestPackageResource;
use Filament\Resources\Pages\EditRecord;

class EditTestPackage extends EditRecord
{
    protected static string $resource = TestPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
