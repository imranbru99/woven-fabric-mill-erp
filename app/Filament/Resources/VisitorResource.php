<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\VisitorResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Visitor;

class VisitorResource extends MillResource
{
    protected static ?string $model = Visitor::class;

    protected static ?string $navigationGroup = 'Dispatch & Gate';

    protected static ?string $navigationLabel = 'Visitors';

    protected static ?int $navigationSort = 135;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisitors::route('/'),
            'create' => Pages\CreateVisitor::route('/create'),
            'view' => Pages\ViewVisitor::route('/{record}'),
            'edit' => Pages\EditVisitor::route('/{record}/edit'),
        ];
    }
}
