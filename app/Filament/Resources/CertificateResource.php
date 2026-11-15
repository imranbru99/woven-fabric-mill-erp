<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CertificateResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Certificate;

class CertificateResource extends MillResource
{
    protected static ?string $model = Certificate::class;

    protected static ?string $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Certificates';

    protected static ?int $navigationSort = 172;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCertificates::route('/'),
            'create' => Pages\CreateCertificate::route('/create'),
            'view' => Pages\ViewCertificate::route('/{record}'),
            'edit' => Pages\EditCertificate::route('/{record}/edit'),
        ];
    }
}
