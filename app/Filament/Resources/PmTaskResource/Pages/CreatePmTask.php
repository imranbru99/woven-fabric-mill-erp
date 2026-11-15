<?php

declare(strict_types=1);

namespace App\Filament\Resources\PmTaskResource\Pages;

use App\Filament\Resources\PmTaskResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePmTask extends CreateRecord
{
    protected static string $resource = PmTaskResource::class;

}
