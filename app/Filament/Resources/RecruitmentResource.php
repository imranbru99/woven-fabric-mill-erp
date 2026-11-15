<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RecruitmentResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Recruitment;

class RecruitmentResource extends MillResource
{
    protected static ?string $model = Recruitment::class;

    protected static ?string $navigationGroup = 'HR & Payroll';

    protected static ?string $navigationLabel = 'Recruitments';

    protected static ?int $navigationSort = 160;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecruitments::route('/'),
            'create' => Pages\CreateRecruitment::route('/create'),
            'view' => Pages\ViewRecruitment::route('/{record}'),
            'edit' => Pages\EditRecruitment::route('/{record}/edit'),
        ];
    }
}
