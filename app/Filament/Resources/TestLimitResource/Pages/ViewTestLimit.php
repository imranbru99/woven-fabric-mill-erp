<?php

declare(strict_types=1);

namespace App\Filament\Resources\TestLimitResource\Pages;

use App\Filament\Resources\TestLimitResource;
use Filament\Resources\Pages\ViewRecord;

class ViewTestLimit extends ViewRecord
{
    protected static string $resource = TestLimitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
