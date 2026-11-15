<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Concerns\ConfiguresMillPanel;
use Filament\Panel;
use Filament\PanelProvider;

class SupplierPanelProvider extends PanelProvider
{
    use ConfiguresMillPanel;

    public function panel(Panel $panel): Panel
    {
        return $this->mill($panel, 'supplier', 'supplier')
            ->discoverPages(in: app_path('Filament/Supplier/Pages'), for: 'App\\Filament\\Supplier\\Pages');
    }
}
