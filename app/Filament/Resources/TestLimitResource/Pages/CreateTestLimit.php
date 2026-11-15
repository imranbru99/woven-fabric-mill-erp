<?php

declare(strict_types=1);

namespace App\Filament\Resources\TestLimitResource\Pages;

use App\Filament\Resources\TestLimitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTestLimit extends CreateRecord
{
    protected static string $resource = TestLimitResource::class;

}
