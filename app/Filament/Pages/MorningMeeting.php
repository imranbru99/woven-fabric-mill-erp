<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Models\Issue;
use App\Services\ReportCatalog;
use Filament\Pages\Page;

class MorningMeeting extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $navigationGroup = 'Issues';

    protected static ?string $navigationLabel = 'Morning meeting';

    protected static string $view = 'filament.pages.morning-meeting';

    protected function getViewData(): array
    {
        $catalog = app(ReportCatalog::class);

        return [
            'issues' => Issue::query()->whereNotIn('status', ['closed'])->orderByRaw("case severity when 'critical' then 1 when 'high' then 2 when 'medium' then 3 else 4 end")->limit(12)->get(),
            'metres' => $catalog->run('production_metres.today'),
            'efficiency' => $catalog->run('avg_efficiency.today'),
            'stoppages' => $catalog->run('stoppage_minutes.today'),
        ];
    }
}
