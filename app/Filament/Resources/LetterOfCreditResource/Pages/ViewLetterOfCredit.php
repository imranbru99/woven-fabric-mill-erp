<?php

declare(strict_types=1);

namespace App\Filament\Resources\LetterOfCreditResource\Pages;

use App\Filament\Resources\LetterOfCreditResource;
use Filament\Resources\Pages\ViewRecord;

class ViewLetterOfCredit extends ViewRecord
{
    protected static string $resource = LetterOfCreditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
        ];
    }
}
