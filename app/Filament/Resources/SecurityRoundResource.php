<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SecurityRoundResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\SecurityRound;

class SecurityRoundResource extends MillResource
{
    protected static ?string $model = SecurityRound::class;

    protected static ?string $navigationGroup = 'Dispatch & Gate';

    protected static ?string $navigationLabel = 'Security Rounds';

    protected static ?int $navigationSort = 136;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSecurityRounds::route('/'),
            'create' => Pages\CreateSecurityRound::route('/create'),
            'view' => Pages\ViewSecurityRound::route('/{record}'),
            'edit' => Pages\EditSecurityRound::route('/{record}/edit'),
        ];
    }
}
