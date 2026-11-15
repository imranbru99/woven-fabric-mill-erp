<?php

declare(strict_types=1);

namespace App\Filament\Resources\PriceListLineResource\Pages;

use App\Filament\Resources\PriceListLineResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePriceListLine extends CreateRecord
{
    protected static string $resource = PriceListLineResource::class;

}
