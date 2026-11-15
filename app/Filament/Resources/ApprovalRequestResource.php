<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ApprovalRequestResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\ApprovalRequest;

class ApprovalRequestResource extends MillResource
{
    protected static ?string $model = ApprovalRequest::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Approval Requests';

    protected static ?int $navigationSort = 21;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApprovalRequests::route('/'),
            'create' => Pages\CreateApprovalRequest::route('/create'),
            'view' => Pages\ViewApprovalRequest::route('/{record}'),
            'edit' => Pages\EditApprovalRequest::route('/{record}/edit'),
        ];
    }
}
