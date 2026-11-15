<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Concerns\ConfiguresMillPanel;
use Filament\Panel;
use Filament\PanelProvider;

class FloorPanelProvider extends PanelProvider
{
    use ConfiguresMillPanel;

    public function panel(Panel $panel): Panel
    {
        return $this->mill($panel, 'floor', 'floor')
            ->topNavigation()
            ->discoverPages(in: app_path('Filament/Floor/Pages'), for: 'App\\Filament\\Floor\\Pages');
    }
}
