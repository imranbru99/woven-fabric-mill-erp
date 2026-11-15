<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BudgetResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Budget;

class BudgetResource extends MillResource
{
    protected static ?string $model = Budget::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Budgets';

    protected static ?int $navigationSort = 148;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBudgets::route('/'),
            'create' => Pages\CreateBudget::route('/create'),
            'view' => Pages\ViewBudget::route('/{record}'),
            'edit' => Pages\EditBudget::route('/{record}/edit'),
        ];
    }
}
