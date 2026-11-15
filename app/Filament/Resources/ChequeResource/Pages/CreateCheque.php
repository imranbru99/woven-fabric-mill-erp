<?php

declare(strict_types=1);

namespace App\Filament\Resources\ChequeResource\Pages;

use App\Filament\Resources\ChequeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCheque extends CreateRecord
{
    protected static string $resource = ChequeResource::class;

}
