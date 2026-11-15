<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Company;

class CompanyResource extends MillResource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Companies';

    protected static ?int $navigationSort = 2;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
