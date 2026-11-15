<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\TaxRuleResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\TaxRule;

class TaxRuleResource extends MillResource
{
    protected static ?string $model = TaxRule::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Tax Rules';

    protected static ?int $navigationSort = 32;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaxRules::route('/'),
            'create' => Pages\CreateTaxRule::route('/create'),
            'view' => Pages\ViewTaxRule::route('/{record}'),
            'edit' => Pages\EditTaxRule::route('/{record}/edit'),
        ];
    }
}
