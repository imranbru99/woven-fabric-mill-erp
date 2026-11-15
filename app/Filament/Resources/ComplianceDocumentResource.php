<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\ComplianceDocumentResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\ComplianceDocument;

class ComplianceDocumentResource extends MillResource
{
    protected static ?string $model = ComplianceDocument::class;

    protected static ?string $navigationGroup = 'HR & Payroll';

    protected static ?string $navigationLabel = 'Compliance Documents';

    protected static ?int $navigationSort = 162;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplianceDocuments::route('/'),
            'create' => Pages\CreateComplianceDocument::route('/create'),
            'view' => Pages\ViewComplianceDocument::route('/{record}'),
            'edit' => Pages\EditComplianceDocument::route('/{record}/edit'),
        ];
    }
}
