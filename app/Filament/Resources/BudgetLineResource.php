<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\BudgetLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\BudgetLine;

class BudgetLineResource extends MillResource
{
    protected static ?string $model = BudgetLine::class;

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Budget Lines';

    protected static ?int $navigationSort = 149;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBudgetLines::route('/'),
            'create' => Pages\CreateBudgetLine::route('/create'),
            'view' => Pages\ViewBudgetLine::route('/{record}'),
            'edit' => Pages\EditBudgetLine::route('/{record}/edit'),
        ];
    }
}
