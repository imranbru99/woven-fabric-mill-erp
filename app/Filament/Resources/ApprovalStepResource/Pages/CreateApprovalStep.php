<?php

declare(strict_types=1);

namespace App\Filament\Resources\ApprovalStepResource\Pages;

use App\Filament\Resources\ApprovalStepResource;
use Filament\Resources\Pages\CreateRecord;

class CreateApprovalStep extends CreateRecord
{
    protected static string $resource = ApprovalStepResource::class;

}
