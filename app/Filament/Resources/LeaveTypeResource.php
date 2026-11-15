<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\LeaveTypeResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\LeaveType;

class LeaveTypeResource extends MillResource
{
    protected static ?string $model = LeaveType::class;

    protected static ?string $navigationGroup = 'HR & Payroll';

    protected static ?string $navigationLabel = 'Leave Types';

    protected static ?int $navigationSort = 154;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaveTypes::route('/'),
            'create' => Pages\CreateLeaveType::route('/create'),
            'view' => Pages\ViewLeaveType::route('/{record}'),
            'edit' => Pages\EditLeaveType::route('/{record}/edit'),
        ];
    }
}
