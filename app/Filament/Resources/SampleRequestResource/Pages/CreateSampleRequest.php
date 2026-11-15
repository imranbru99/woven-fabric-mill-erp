<?php

declare(strict_types=1);

namespace App\Filament\Resources\SampleRequestResource\Pages;

use App\Filament\Resources\SampleRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSampleRequest extends CreateRecord
{
    protected static string $resource = SampleRequestResource::class;

}
