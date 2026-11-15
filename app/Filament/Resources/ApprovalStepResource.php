<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ApprovalStepResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\ApprovalStep;

class ApprovalStepResource extends MillResource
{
    protected static ?string $model = ApprovalStep::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Approval Steps';

    protected static ?int $navigationSort = 20;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApprovalSteps::route('/'),
            'create' => Pages\CreateApprovalStep::route('/create'),
            'view' => Pages\ViewApprovalStep::route('/{record}'),
            'edit' => Pages\EditApprovalStep::route('/{record}/edit'),
        ];
    }
}
