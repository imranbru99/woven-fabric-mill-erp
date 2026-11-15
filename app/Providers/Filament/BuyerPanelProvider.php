<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Concerns\ConfiguresMillPanel;
use Filament\Panel;
use Filament\PanelProvider;

class BuyerPanelProvider extends PanelProvider
{
    use ConfiguresMillPanel;

    public function panel(Panel $panel): Panel
    {
        return $this->mill($panel, 'buyer', 'buyer')
            ->discoverPages(in: app_path('Filament/Buyer/Pages'), for: 'App\\Filament\\Buyer\\Pages');
    }
}
