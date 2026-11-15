<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ApprovalFlowResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\ApprovalFlow;

class ApprovalFlowResource extends MillResource
{
    protected static ?string $model = ApprovalFlow::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Approval Flows';

    protected static ?int $navigationSort = 19;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApprovalFlows::route('/'),
            'create' => Pages\CreateApprovalFlow::route('/create'),
            'view' => Pages\ViewApprovalFlow::route('/{record}'),
            'edit' => Pages\EditApprovalFlow::route('/{record}/edit'),
        ];
    }
}
