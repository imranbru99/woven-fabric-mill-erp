<?php

declare(strict_types=1);

namespace App\Filament\Resources\JournalLineResource\Pages;

use App\Filament\Resources\JournalLineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJournalLine extends CreateRecord
{
    protected static string $resource = JournalLineResource::class;

}
