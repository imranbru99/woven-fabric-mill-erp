<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\AttachmentResource\Pages;
use App\Filament\Support\MillResource;
use App\Models\Attachment;

class AttachmentResource extends MillResource
{
    protected static ?string $model = Attachment::class;

    protected static ?string $navigationGroup = 'Foundation';

    protected static ?string $navigationLabel = 'Attachments';

    protected static ?int $navigationSort = 23;

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttachments::route('/'),
            'create' => Pages\CreateAttachment::route('/create'),
            'view' => Pages\ViewAttachment::route('/{record}'),
            'edit' => Pages\EditAttachment::route('/{record}/edit'),
        ];
    }
}
