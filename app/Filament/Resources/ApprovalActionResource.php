<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ApprovalActionResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\ApprovalAction;

class ApprovalActionResource extends MillResource
{
    protected static ?string $model = ApprovalAction::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Approval Actions';

    protected static ?int $navigationSort = 22;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApprovalActions::route('/'),
            'create' => Pages\CreateApprovalAction::route('/create'),
            'view' => Pages\ViewApprovalAction::route('/{record}'),
            'edit' => Pages\EditApprovalAction::route('/{record}/edit'),
        ];
    }
}
