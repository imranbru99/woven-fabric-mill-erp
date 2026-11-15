<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeLoanResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\EmployeeLoan;

class EmployeeLoanResource extends MillResource
{
    protected static ?string $model = EmployeeLoan::class;

    protected static ?string $navigationGroup = 'HR & Payroll';

    protected static ?string $navigationLabel = 'Employee Loans';

    protected static ?int $navigationSort = 159;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployeeLoans::route('/'),
            'create' => Pages\CreateEmployeeLoan::route('/create'),
            'view' => Pages\ViewEmployeeLoan::route('/{record}'),
            'edit' => Pages\EditEmployeeLoan::route('/{record}/edit'),
        ];
    }
}
