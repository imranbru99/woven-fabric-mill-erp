<?php

declare(strict_types=1);

namespace App\Filament\Resources\BillOfEntryResource\Pages;

use App\Filament\Resources\BillOfEntryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBillOfEntry extends CreateRecord
{
    protected static string $resource = BillOfEntryResource::class;

}
