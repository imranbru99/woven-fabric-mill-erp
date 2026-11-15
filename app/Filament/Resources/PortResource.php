<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PortResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Port;

class PortResource extends MillResource
{
    protected static ?string $model = Port::class;

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Ports';

    protected static ?int $navigationSort = 35;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPorts::route('/'),
            'create' => Pages\CreatePort::route('/create'),
            'view' => Pages\ViewPort::route('/{record}'),
            'edit' => Pages\EditPort::route('/{record}/edit'),
        ];
    }
}
