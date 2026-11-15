<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Services\ReportCatalog;
use Filament\Pages\Page;

class ReportLibrary extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?string $navigationGroup = 'Accounts';

    protected static ?string $navigationLabel = 'Report library';

    protected static string $view = 'filament.pages.report-library';

    public string $report = 'production_metres.all';

    /** @var array<string, mixed>|null */
    public ?array $result = null;

    public function runReport(): void
    {
        $this->result = app(ReportCatalog::class)->run($this->report);
    }

    protected function getViewData(): array
    {
        return ['reports' => app(ReportCatalog::class)->names()];
    }
}
