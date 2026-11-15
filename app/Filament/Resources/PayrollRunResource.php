<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PayrollRunResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\PayrollRun;

class PayrollRunResource extends MillResource
{
    protected static ?string $model = PayrollRun::class;

    protected static ?string $navigationGroup = 'HR & Payroll';

    protected static ?string $navigationLabel = 'Payroll Runs';

    protected static ?int $navigationSort = 157;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayrollRuns::route('/'),
            'create' => Pages\CreatePayrollRun::route('/create'),
            'view' => Pages\ViewPayrollRun::route('/{record}'),
            'edit' => Pages\EditPayrollRun::route('/{record}/edit'),
        ];
    }
}
