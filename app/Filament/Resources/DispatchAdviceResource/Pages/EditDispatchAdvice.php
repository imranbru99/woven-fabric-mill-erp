<?php

declare(strict_types=1);

namespace App\Filament\Resources\DispatchAdviceResource\Pages;

use App\Filament\Resources\DispatchAdviceResource;
use Filament\Resources\Pages\EditRecord;

class EditDispatchAdvice extends EditRecord
{
    protected static string $resource = DispatchAdviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\ViewAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
