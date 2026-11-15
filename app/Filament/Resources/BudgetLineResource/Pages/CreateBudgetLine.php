<?php

declare(strict_types=1);

namespace App\Filament\Resources\BudgetLineResource\Pages;

use App\Filament\Resources\BudgetLineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBudgetLine extends CreateRecord
{
    protected static string $resource = BudgetLineResource::class;

}
