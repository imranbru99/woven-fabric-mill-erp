<?php

declare(strict_types=1);

namespace App\Filament\Resources\CostSheetLineResource\Pages;

use App\Filament\Resources\CostSheetLineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCostSheetLine extends CreateRecord
{
    protected static string $resource = CostSheetLineResource::class;

}
