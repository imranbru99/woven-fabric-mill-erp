<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PayrollLineResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PayrollLine;

class PayrollLineResource extends MillResource
{
    protected static ?string $model = PayrollLine::class;

    protected static ?string $navigationGroup = 'HR & Payroll';

    protected static ?string $navigationLabel = 'Payroll Lines';

    protected static ?int $navigationSort = 158;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayrollLines::route('/'),
            'create' => Pages\CreatePayrollLine::route('/create'),
            'view' => Pages\ViewPayrollLine::route('/{record}'),
            'edit' => Pages\EditPayrollLine::route('/{record}/edit'),
        ];
    }
}
