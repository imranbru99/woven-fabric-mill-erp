<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\EtpLogResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\EtpLog;

class EtpLogResource extends MillResource
{
    protected static ?string $model = EtpLog::class;

    protected static ?string $navigationGroup = 'Maintenance';

    protected static ?string $navigationLabel = 'ETP logs';

    protected static ?int $navigationSort = 126;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEtpLogs::route('/'),
            'create' => Pages\CreateEtpLog::route('/create'),
            'view' => Pages\ViewEtpLog::route('/{record}'),
            'edit' => Pages\EditEtpLog::route('/{record}/edit'),
        ];
    }
}
