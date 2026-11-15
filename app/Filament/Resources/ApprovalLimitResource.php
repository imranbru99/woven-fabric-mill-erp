<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ApprovalLimitResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\ApprovalLimit;

class ApprovalLimitResource extends MillResource
{
    protected static ?string $model = ApprovalLimit::class;

    protected static ?string $navigationGroup = 'Access Control';

    protected static ?string $navigationLabel = 'Approval Limits';

    protected static ?int $navigationSort = 18;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApprovalLimits::route('/'),
            'create' => Pages\CreateApprovalLimit::route('/create'),
            'view' => Pages\ViewApprovalLimit::route('/{record}'),
            'edit' => Pages\EditApprovalLimit::route('/{record}/edit'),
        ];
    }
}
